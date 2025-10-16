import { createContext, useContext, useState, useEffect } from "react";

const ClientContext = createContext({ clientType: null });

const useClient = () => useContext(ClientContext);

const ClientProvider = ({ children }) => {
  const [ client, setClient ] = useState(null);

  useEffect(() => {
    if (client === null) {
      if (window.Telegram?.WebApp?.initData) {
        setClient({ clientType: 'telegram', telegram: window.Telegram })
      } else {
        setClient({ clientType: 'web' })
      }
    }
  }, [ client ]);

  return (
    <ClientContext.Provider value={{ client }}>
      { children }
    </ClientContext.Provider>
  )
}

export { useClient };
export default ClientProvider;
