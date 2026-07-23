# Agendamento com Brevo Meetings

## Decisão de produto

O agendamento usa a página de reservas do Brevo Meetings. A ferramenta de
videoconferência não faz parte deste módulo e permanece sem decisão.

A documentação oficial do Brevo confirma que a página pode ser compartilhada
por link ou incorporada ao site:

- https://help.brevo.com/hc/pt/articles/7333628001938
- https://help.brevo.com/hc/en-us/articles/7073284620306

A V1 utiliza um link externo configurável. Não tenta criar um horário pela API,
pois essa operação não foi identificada na documentação pública oficial.

## Modos

- `after_review`: o escritório analisa a solicitação e encaminha depois o acesso
  à reserva;
- `direct`: o visitante vê o botão para consultar horários diretamente.

O fuso profissional padrão é `America/Cuiaba`. O link nunca recebe o resumo do
caso, email ou telefone como parâmetro.

## Demonstração e produção

Em demonstração, o provedor obrigatório é `fake` e o endereço usa
`example.test`. O modelo bloqueia a ativação acidental do provedor Brevo.

Para ativar em produção:

1. criar e configurar a página em Conversas > Meetings no Brevo;
2. definir os tipos de reunião e disponibilidades;
3. copiar o link da página ou do tipo de reunião;
4. desativar `MARACUJA_DEMO_MODE`;
5. escolher `Brevo Meetings` em Atendimento > Agendamento;
6. informar o link, o modo e o fuso horário;
7. testar uma reserva fictícia antes da abertura ao público.

Os webhooks oficiais de reunião agendada e cancelada existem, mas não são
ativados neste lote sem conta, segredo e payload real validados. Nenhuma função
de vídeo Brevo, Zoom ou Google Meet é configurada.
