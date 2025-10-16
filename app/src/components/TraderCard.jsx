import './../assets/scss/components/traders/TraderCard.scss';

const TraderCard = ({ trader, client }) => {
  const { name, description } = trader;

  const handleClick = () => {}
  const handleTelegramClick = () => {
    client.telegram.WebApp.showPopup({
      title: name,
      message: 'какое нибудь полное описание трейдера, пока это тупо заглушка',
      buttons: [
        { id: "details", type: "default", text: "Подробнее" },
        { type: "cancel" }
      ]
    }, buttonId => {

    });
  }

  return (
    <article className="TraderCard" onClick={ client?.clientType === 'telegram' ? handleTelegramClick : handleClick }>
      <div className="TraderCard-name">{ name }</div>
      <div className="TraderCard-description">{ description }</div>
    </article>
  )
}

export default TraderCard;
