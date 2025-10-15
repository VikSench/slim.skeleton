import './../assets/scss/layouts/MainLayout.scss';

import { useTelegram } from '../providers/TelegramProvider';
// import { Outlet } from 'react-router-dom';
import { useEffect } from 'react';
import axios from 'axios';

const MainLayout = () => {
  const { telegramWebApp } = useTelegram();

  useEffect(() => {
    if (telegramWebApp) {
      axios.post('https://commodious-overlusciously-estell.ngrok-free.dev/api/v1/logger/telegram', {}, {
        headers: {
          Authorization: `Telegram ${telegramWebApp.initData}`
        },
      })
        .then(res => console.log(res))
        .catch(console.error);
    }
  }, [ telegramWebApp ]);

  return (
    <div className="MainLayout">
      <header className="MainLayout-header">
        <div className="MainLayout-header-container">
          {telegramWebApp
            ? (
              <div>
                Telegram agent v1.001
              </div>
            )
            : (
              <div>Not a telegram agent</div>
            )
          }
        </div>
      </header>
      <main className="MainLayout-content">

        <div className="MainLayout-content-container">
          <div>
          { JSON.stringify(telegramWebApp?.initData) }
          </div>
          {/* <Outlet /> */}
        </div>
      </main>
      <footer className="MainLayout-footer">
        <div className="MainLayout-footer-container">
          FOOTER
        </div>
      </footer>
    </div>
  );
};

export default MainLayout;
