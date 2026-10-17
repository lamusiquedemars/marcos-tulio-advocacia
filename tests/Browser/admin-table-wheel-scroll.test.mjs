import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';
import vm from 'node:vm';

const hook = readFileSync(new URL('../../resources/views/filament/hooks/table-wheel-scroll.blade.php', import.meta.url), 'utf8');
const script = hook.match(/<script[^>]*>([\s\S]*)<\/script>/)[1];

function setup({ width = 300, content = 900, left = 0, control = false, inside = true } = {}) {
    const container = { clientWidth: width, scrollWidth: content, scrollLeft: left };
    class Element {
        closest(selector) {
            return selector.startsWith('.admin-data-table') ? (inside ? container : null) : (control ? this : null);
        }
    }
    const handlers = [];
    const context = vm.createContext({ window: {}, Element, document: {
        addEventListener(name, callback, options) { handlers.push({ name, callback, options }); },
    } });
    vm.runInContext(script, context);
    vm.runInContext(script, context);
    assert.equal(handlers.length, 1, 'Livewire navigation must not register the handler twice');
    assert.equal(handlers[0].name, 'wheel');
    assert.equal(handlers[0].options.passive, false);
    return { container, wheel(overrides = {}) {
        let prevented = false;
        handlers[0].callback({ target: new Element(), deltaX: 0, deltaY: 120, deltaMode: 0,
            preventDefault() { prevented = true; }, ...overrides });
        return prevented;
    } };
}

test('wheel scrolls overflowing table content, then releases the page at its edge', () => {
    const { container, wheel } = setup();
    assert.equal(wheel(), true);
    assert.equal(container.scrollLeft, 120);
    assert.equal(wheel({ deltaY: 1000 }), true);
    assert.equal(container.scrollLeft, 600);
    assert.equal(wheel(), false);
    assert.equal(wheel({ deltaY: -1000 }), true);
    assert.equal(container.scrollLeft, 0);
    assert.equal(wheel({ deltaY: -120 }), false);
});

test('tables without horizontal overflow and areas outside tables retain normal scrolling', () => {
    assert.equal(setup({ content: 300 }).wheel(), false);
    assert.equal(setup({ inside: false }).wheel(), false);
});

test('zoom, horizontal trackpad gestures, controls and action menus are untouched', () => {
    for (const event of [{ ctrlKey: true }, { deltaX: 150 }, { defaultPrevented: true }]) {
        const { container, wheel } = setup();
        assert.equal(wheel(event), false);
        assert.equal(container.scrollLeft, 0);
    }
    assert.equal(setup({ control: true }).wheel(), false);
});

test('line and page wheel units are converted before scrolling', () => {
    const { container, wheel } = setup();
    wheel({ deltaY: 2, deltaMode: 1 });
    assert.equal(container.scrollLeft, 32);
    wheel({ deltaY: 1, deltaMode: 2 });
    assert.equal(container.scrollLeft, 332);
});
