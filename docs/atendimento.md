# Atendimento

O módulo de solicitações registra apenas as informações iniciais necessárias
para organizar o primeiro contato. Ele não é um CRM jurídico e não deve receber
documentos, senhas, relatos completos ou dados desnecessários de terceiros.

## Dados estruturados

- nome, email e telefone;
- tipo de solicitação;
- urgência;
- fase geral;
- eventual data importante;
- cidade e estado;
- modalidade presencial, remota ou a definir;
- resumo inicial;
- consentimento e data;
- origem e estado do acompanhamento.

Estados disponíveis: `nova`, `em_contato`, `consulta_solicitada`, `agendada` e
`encerrada`.

O resumo não é copiado para o link de resposta por email, evitando que
informações potencialmente sensíveis apareçam em uma URL. Também não é enviado
ao módulo de audiência/Brevo.

## Demonstração

O seeder cria uma solicitação explicitamente fictícia com endereço
`example.test`. As configurações semeadas desativam o email administrativo e a
confirmação automática. Nenhum contato real deve ser usado enquanto
`MARACUJA_DEMO_MODE=true`.

Em produção, a política de retenção e exclusão das solicitações deverá ser
validada antes de aceitar dados reais.
