import './../assets/scss/components/traders/TraderCard.scss';

const TraderCard = ({ trader }) => {
  const { name, description } = trader;

  return (
    <article className="TraderCard">
      <div className="TraderCard-name">{ name }</div>
      <div className="TraderCard-description">{ description }</div>
    </article>
  )
}

export default TraderCard;
