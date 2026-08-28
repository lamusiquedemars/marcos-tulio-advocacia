# Agendamento com Brevo Meetings

## Decisão de produto

O agendamento usa a página de reservas do Brevo Meetings. A ferramenta de
videoconferência não faz parte deste módulo e permanece sem decisão.

A documentação oficial do Brevo confirma que a página pode ser compartilhada
por link ou incorporada ao site:

- https://help.brevo.com/hc/pt/articles/7333628001938
- https://help.brevo.com/hc/en-us/articles/7073284620306

A configuração conserva os links Brevo por tipo de consulta, mas não há link
público de reserva na navegação. Após a qualificação de uma solicitação, a
equipe cria um convite privado no domínio do escritório:
`/agendamento/convite/{token}`. Cette adresse est valable sept jours et
incorpora então o tipo Brevo escolhido na mesma página, sem nova aba ou login
Brevo para o visitante.

O token protege o acesso normal pelo site; ele não transforma o link Brevo
subjacente em link criptograficamente de uso único. A documentação pública do
Brevo não oferece API para criar esse tipo de link temporário no provedor. Essa
limitação é assumida: são usados apenas tipos ocultos e convites do escritório.

O módulo não tenta criar um horário pela API, pois essa operação não foi
identificada na documentação pública oficial.

## Modos

- `after_review`: o escritório analisa a solicitação e envia depois um convite
  privado, online ou presencial, por e-mail ou WhatsApp;
- `direct`: o visitante vê o botão para consultar horários diretamente.

O fuso profissional padrão é `America/Cuiaba`. O link nunca recebe o resumo do
caso, email ou telefone como parâmetro.

## Demonstração e produção

Em demonstração, o provedor obrigatório é `fake` e o endereço usa
`example.test`. O modelo bloqueia a ativação acidental do provedor Brevo.

A ativação pública do Brevo depende de um teste com a conta real confirmando:

- incorporação dentro do site;
- percurso completo em português brasileiro;
- ausência de login Brevo para o visitante;
- confirmação e lembretes em idioma aceitável.

Se um desses pontos falhar, a integração pública não será ativada.

Para ativar em produção:

1. criar e configurar a página em Conversas > Meetings no Brevo;
2. definir os tipos de reunião e disponibilidades;
3. copiar os links específicos dos tipos de reunião online e presencial;
4. desativar `MARACUJA_DEMO_MODE`;
5. escolher `Brevo Meetings` em Atendimento > Agendamento;
6. informar os dois links, o modo `after_review` e o fuso horário;
7. enviar um convite de teste em `Atendimento > Solicitações recebidas`;
8. testar uma reserva fictícia antes de qualquer comunicação pública.

Os webhooks oficiais de reunião agendada e cancelada existem, mas não são
ativados neste lote sem conta, segredo e payload real validados. Nenhuma função
de vídeo Brevo, Zoom ou Google Meet é configurada.
