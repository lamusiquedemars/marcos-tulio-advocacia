# Sustentações e Defesas

O módulo `oral_defenses` administra a seleção pública de sustentações e exemplos
anonimizados de defesa.

## Regras de publicação

- somente um vídeo principal pode estar publicado;
- no máximo seis vídeos secundários podem estar publicados;
- o sistema nunca arquiva nem substitui um conteúdo automaticamente;
- um vídeo publicado precisa de um link público ou de um arquivo MP4/WebM da
  biblioteca de mídia;
- um exemplo de defesa só pode ser publicado após confirmação da anonimização;
- conteúdos arquivados e rascunhos não aparecem no site.

As validações ficam no modelo e também protegem importações, seeders e futuras
integrações, não apenas o formulário Filament.

## Modo demonstração

O seeder cria um exemplo de defesa inteiramente fictício e um vídeo em rascunho,
sem chamar serviços externos. Vídeos reais só devem ser adicionados após
autorização expressa.

Ativação:

```dotenv
MARACUJA_MODULE_ORAL_DEFENSES=true
```

Arquivos de vídeo aceitos: MP4 e WebM, até 100 MB. Para hospedagens com limite
de upload inferior, usar um link de vídeo autorizado ou ajustar de forma
coerente o PHP do servidor e `maracuja.media.video_max_size_kb`.
