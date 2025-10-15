import { createContext, useContext, useState, useEffect } from "react";

const TelegramContext = createContext({ telegramWebApp: null });

const useTelegram = () => useContext(TelegramContext);

const TelegramProvider = ({ children }) => {
  const [ telegramWebApp, setTelegramWebApp ] = useState(null);

  useEffect(() => {
      setTelegramWebApp(window.Telegram?.WebApp);
  }, []);

  return (
    <TelegramContext.Provider value={{ telegramWebApp }}>
      { children }
    </TelegramContext.Provider>
  )
}

export { useTelegram };
export default TelegramProvider;
