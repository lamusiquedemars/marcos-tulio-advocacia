import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import { after, before, test } from 'node:test';
import { chromium } from 'playwright';

const manifest = JSON.parse(readFileSync(new URL('../../public/build/manifest.json', import.meta.url)));
const css = readFileSync(new URL(`../../public/build/${manifest['resources/css/filament/admin/tables.css'].file}`, import.meta.url), 'utf8');
const filamentCss = readFileSync(new URL('../../public/css/filament/filament/app.css', import.meta.url), 'utf8');
let browser;

before(async () => {
    // Headless Chromium hides scrollbars by default. That would mask this regression.
    browser = await chromium.launch({ headless: true, ignoreDefaultArgs: ['--hide-scrollbars'] });
});
after(async () => { await browser?.close(); });

for (const dark of [false, true]) {
    for (const report of [false, true]) {
        test(`native scrollbar is visible and draggable: ${report ? 'report' : 'Filament'} / ${dark ? 'dark' : 'light'}`, async () => {
            const page = await browser.newPage({ viewport: { width: 390, height: 600 } });
            try {
                // The same root / scrollport / table hierarchy as the rendered Filament DOM.
                await page.setContent(`<html class="${dark ? 'dark' : ''}"><body>
                    <div class="fi-ta admin-data-table" style="width:350px;margin:20px">
                        <div class="${report ? 'admin-table-scroll' : 'fi-ta-content-ctn'}">
                            <table class="fi-ta-table"><thead><tr><th>Nome</th><th>Email</th><th>Estado</th><th>Ações</th></tr></thead>
                            <tbody><tr><td>Contato de teste</td><td>teste@example.test</td><td>Novo</td><td>Editar</td></tr></tbody></table>
                        </div>
                    </div></body></html>`);
                await page.addStyleTag({ content: filamentCss });
                await page.addStyleTag({ content: css });
                const port = page.locator(report ? '.admin-table-scroll' : '.fi-ta-content-ctn');
                const geometry = await port.evaluate(element => ({
                    overflow: element.scrollWidth > element.clientWidth,
                    // Real reserved native scrollbar space, not just a CSS declaration.
                    scrollbarHeight: element.offsetHeight - element.clientHeight,
                    pageWidth: document.documentElement.scrollWidth,
                }));
                assert.equal(geometry.overflow, true);
                assert.ok(geometry.scrollbarHeight >= 14, `Native scrollbar hidden (${geometry.scrollbarHeight}px)`);
                assert.equal(geometry.pageWidth, 390);
                const box = await port.boundingBox();
                await page.mouse.move(box.x + 50, box.y + box.height - 7);
                await page.mouse.down();
                await page.mouse.move(box.x + 200, box.y + box.height - 7, { steps: 8 });
                await page.mouse.up();
                assert.ok(await port.evaluate(element => element.scrollLeft) > 0, 'Dragging the native thumb must move the table');
            } finally {
                await page.close();
            }
        });
    }
}
