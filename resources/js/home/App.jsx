import React, { useEffect } from 'react';
import { Routes, Route, useLocation } from 'react-router-dom';

import AOS from 'aos';

import { LanguageProvider } from './utils/LanguageContext';

import Home from './pages/Home';
import SignIn from './pages/SignIn';
import SignUp from './pages/SignUp';
import ResetPassword from './pages/ResetPassword';

function App() {
    const location = useLocation();

    useEffect(() => {
        AOS.init({
            once: true,
            disable: 'phone',
            duration: 700,
            easing: 'ease-out-cubic',
        });
    });

    useEffect(() => {
        document.querySelector('html').style.scrollBehavior = 'auto';
        window.scroll({ top: 0 });
        document.querySelector('html').style.scrollBehavior = '';
    }, [location.pathname]); // triggered on route change

    return (
        <LanguageProvider>
            <Routes>
                <Route exact path="/" element={<Home />} />
                <Route path="/signin" element={<SignIn />} />
                <Route path="/signup" element={<SignUp />} />
                <Route path="/reset-password" element={<ResetPassword />} />
            </Routes>
        </LanguageProvider>
    );
}

export default App;
