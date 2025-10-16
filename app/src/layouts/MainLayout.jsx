import { useClient } from '../providers/ClientProvider';
import './../assets/scss/layouts/MainLayout.scss';

import { Outlet } from 'react-router-dom';

const MainLayout = () => {
  const { client } = useClient();

  if (client?.clientType === 'telegram') {
    const isMobile = /ios|android/i.test(client.telegram.WebApp.platform);

    if (isMobile) {
      client.telegram.WebApp.requestFullscreen();
    }
  }

  return (
    <div className="MainLayout">
      <header className="MainLayout-header">
        <div className="MainLayout-header-container">
          { client?.clientType }
        </div>
      </header>
      <main className="MainLayout-content">
        <div className="MainLayout-content-container">
          <Outlet />
        </div>
      </main>
      <footer className="MainLayout-footer">
        <div className="MainLayout-footer-container">
          { client?.clientType === 'telegram' && (client.telegram.WebApp.platform) }
        </div>
      </footer>
    </div>
  );
};

export default MainLayout;
