import './assets/css/reset.css';

import { Suspense } from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import MainLayout from './layouts/MainLayout';
import HomePage from './pages/HomePage';

const App = () => (
  <BrowserRouter>
    <Suspense fallback="Loading">
      <Routes>
        <Route element={<MainLayout />}>
          <Route path='/' element={<HomePage />} />
        </Route>
      </Routes>
    </Suspense>
  </BrowserRouter>
);

export default App;
