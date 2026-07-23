# Assistente de primeiro contato

O assistente é uma interface progressiva para qualificar o primeiro contato. Ele
não presta aconselhamento jurídico, não estima chances de sucesso, não promete
resultado e nunca bloqueia o acesso direto ao WhatsApp.

## Arquitetura

O navegador envia respostas estruturadas a um endpoint Laravel. Esse endpoint
depende do contrato `AssistantProvider`, e não de um SDK externo. O único
adaptador disponível no modo demonstração é `FakeAssistantProvider`.

```dotenv
MARACUJA_MODULE_ASSISTANT=true
MARACUJA_ASSISTANT_PROVIDER=fake
MARACUJA_INQUIRY_RETENTION_DAYS=90
```

Nenhuma chave de fornecedor é necessária ou aceita neste lote. A ativação de um
fornecedor real exigirá uma validação separada de confidencialidade, retenção,
localização dos dados e contratos, além de um novo adaptador no servidor.

## Dados

O cenário recolhe o tipo de solicitação, a urgência, a fase geral, a modalidade,
os contatos mínimos, um resumo limitado a 1.500 caracteres e o consentimento.
Em seguida, cria uma solicitação com a origem `assistant_fake`.

O relato não é enviado ao Brevo, adicionado a URLs ou escrito explicitamente
nos logs. Emails e notificações externas não são acionados por este endpoint.

O prazo de conservação configurado prepara um futuro comando de limpeza, mas
nenhuma exclusão automática é ativada antes da validação da política aplicável.
