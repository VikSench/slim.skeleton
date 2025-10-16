import './../assets/scss/components/traders/TradersList.scss';

import axios from "axios";
import TraderCard from "./TraderCard";
import { useEffect, useState } from 'react';
import { useClient } from '../providers/ClientProvider';

const TradersList = () => {
  const traders = [
    {
      id: 1,
      name: "AlphaTrade",
      countries: ["USA", "UK", "Germany"],
      banks: ["HSBC", "Barclays", "Deutsche Bank"],
      description: "Надёжный международный трейдер с опытом более 10 лет.",
      rating: 9.2
    },
    {
      id: 2,
      name: "EuroFX",
      countries: ["France", "Spain", "Italy"],
      banks: ["BNP Paribas", "Santander", "UniCredit"],
      description: "Специализируется на валютных парах евро.",
      rating: 8.5
    },
    {
      id: 3,
      name: "NordInvest",
      countries: ["Sweden", "Norway", "Finland"],
      banks: ["SEB", "Nordea", "Danske Bank"],
      description: "Скандинавская надёжность и прозрачность.",
      rating: 8.9
    },
    {
      id: 4,
      name: "Atlantic Capital",
      countries: ["USA", "Canada"],
      banks: ["Bank of America", "Scotiabank"],
      description: "Фокус на фондовом рынке Северной Америки.",
      rating: 9.0
    },
    {
      id: 5,
      name: "SwissPrime",
      countries: ["Switzerland", "Austria"],
      banks: ["Credit Suisse", "UBS"],
      description: "Швейцарская точность и конфиденциальность.",
      rating: 9.7
    },
    {
      id: 6,
      name: "AsiaTradeHub",
      countries: ["Japan", "Singapore", "Hong Kong"],
      banks: ["Mitsubishi UFJ", "DBS", "HSBC"],
      description: "Торговля с акцентом на азиатские рынки.",
      rating: 8.8
    },
    {
      id: 7,
      name: "PacificTrust",
      countries: ["Australia", "New Zealand"],
      banks: ["ANZ", "Westpac"],
      description: "Надёжный партнёр на рынке Океании.",
      rating: 8.3
    },
    {
      id: 8,
      name: "MiddleEastFinance",
      countries: ["UAE", "Saudi Arabia", "Qatar"],
      banks: ["Emirates NBD", "QNB", "Riyad Bank"],
      description: "Финансовые операции на Ближнем Востоке.",
      rating: 7.9
    },
    {
      id: 9,
      name: "BalticTrade",
      countries: ["Estonia", "Latvia", "Lithuania"],
      banks: ["LHV", "Swedbank"],
      description: "Региональный игрок с растущей репутацией.",
      rating: 7.5
    },
    {
      id: 10,
      name: "IberiaMarkets",
      countries: ["Spain", "Portugal"],
      banks: ["Santander", "CaixaBank"],
      description: "Активная торговля на южноевропейских биржах.",
      rating: 8.1
    },
    {
      id: 11,
      name: "NordicFunds",
      countries: ["Denmark", "Sweden"],
      banks: ["Nordea", "Danske Bank"],
      description: "Инвестиционные фонды северной Европы.",
      rating: 8.6
    },
    {
      id: 12,
      name: "AmeriTradePro",
      countries: ["USA", "Mexico"],
      banks: ["Wells Fargo", "BBVA"],
      description: "Торговля акциями и опционами Америки.",
      rating: 9.1
    },
    {
      id: 13,
      name: "CapitalBridge",
      countries: ["UK", "Ireland"],
      banks: ["Barclays", "Lloyds"],
      description: "Финансовый посредник для корпоративных клиентов.",
      rating: 8.4
    },
    {
      id: 14,
      name: "SwissPeak",
      countries: ["Switzerland"],
      banks: ["UBS", "Julius Baer"],
      description: "Премиум трейдер с высокими стандартами обслуживания.",
      rating: 9.6
    },
    {
      id: 15,
      name: "AsiaPrime",
      countries: ["Japan", "South Korea", "China"],
      banks: ["Mizuho", "Kookmin Bank"],
      description: "Продвинутая торговая платформа для азиатских инвесторов.",
      rating: 8.7
    },
    {
      id: 16,
      name: "OceanicFX",
      countries: ["Australia", "Singapore"],
      banks: ["DBS", "Commonwealth Bank"],
      description: "Форекс-брокер с упором на прозрачность.",
      rating: 7.8
    },
    {
      id: 17,
      name: "BlueRock Capital",
      countries: ["UK", "Germany", "Netherlands"],
      banks: ["HSBC", "ING", "Deutsche Bank"],
      description: "Европейский фонд с сильной аналитикой.",
      rating: 8.9
    },
    {
      id: 18,
      name: "ArcticTrade",
      countries: ["Iceland", "Norway"],
      banks: ["Arion Bank", "DNB"],
      description: "Небольшая, но устойчивая трейдинговая компания.",
      rating: 7.6
    },
    {
      id: 19,
      name: "MediterraneoInvest",
      countries: ["Italy", "Greece", "Spain"],
      banks: ["UniCredit", "Alpha Bank"],
      description: "Традиционные инвестиции с южным колоритом.",
      rating: 8.2
    },
    {
      id: 20,
      name: "GlobalEdge",
      countries: ["USA", "UK", "Singapore", "Switzerland"],
      banks: ["HSBC", "UBS", "Barclays", "DBS"],
      description: "Международная платформа с мультивалютной поддержкой.",
      rating: 9.4
    }
  ];

  const { client } = useClient();

  return (
    <section className="TradersList">
      {traders.map(trader => <TraderCard client={ client } trader={ trader } />)}
    </section>
  );
}

export default TradersList;
