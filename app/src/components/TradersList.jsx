import './../assets/scss/components/traders/TradersList.scss';

import TraderCard from "./TraderCard";

const TradersList = () => {
  const traders = [
    {
      name: "Trader One",
      banks: ["Bank of America", "Chase"],
      description: "Experienced trader specializing in short-term strategies and risk management across multiple markets.",
      currencies: ["USD", "EUR", "JPY"]
    },
    {
      name: "Trader Two",
      banks: ["HSBC", "Citibank", "Wells Fargo"],
      description: "Focuses on currency trading with a keen eye for emerging market opportunities and volatility.",
      currencies: ["GBP", "USD", "AUD"]
    },
    {
      name: "Trader Three",
      banks: ["Deutsche Bank"],
      description: "Long-term investment enthusiast with expertise in portfolio diversification and hedging strategies.",
      currencies: ["EUR", "CHF"]
    },
    {
      name: "Trader Four",
      banks: ["Santander", "Barclays"],
      description: "Passionate about technical analysis and momentum trading, often exploring innovative strategies.",
      currencies: ["USD", "EUR", "GBP", "JPY"]
    },
    {
      name: "Trader Five",
      banks: ["BNP Paribas", "Credit Suisse"],
      description: "Combines fundamental analysis with algorithmic trading to maximize returns across markets.",
      currencies: ["EUR", "USD"]
    },
    {
      name: "Trader Six",
      banks: ["Goldman Sachs"],
      description: "Specializes in commodities and futures, constantly monitoring global economic indicators.",
      currencies: ["USD", "CAD", "AUD"]
    },
    {
      name: "Trader Seven",
      banks: ["Morgan Stanley", "UBS"],
      description: "Focused on risk-adjusted returns and dynamic asset allocation across asset classes.",
      currencies: ["EUR", "GBP", "USD"]
    },
    {
      name: "Trader Eight",
      banks: ["Societe Generale"],
      description: "Expert in options trading with a strong emphasis on volatility and time decay strategies.",
      currencies: ["USD", "JPY"]
    },
    {
      name: "Trader Nine",
      banks: ["ING Bank", "Commerzbank"],
      description: "Specialist in cross-border investments and currency hedging for multinational clients.",
      currencies: ["EUR", "USD", "CHF"]
    },
    {
      name: "Trader Ten",
      banks: ["Royal Bank of Canada", "TD Bank"],
      description: "Focuses on equity markets, combining technical setups with market sentiment analysis.",
      currencies: ["CAD", "USD", "EUR"]
    }
  ];

  return (
    <section className="TradersList">
      {traders.map(trader => <TraderCard trader={ trader } />)}
    </section>
  );
}

export default TradersList;
