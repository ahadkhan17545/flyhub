import React, { useState, useRef, useEffect } from 'react';
import Transition from '../utils/Transition';
import { useLanguage } from '../utils/LanguageContext';
import { translations } from '../utils/translations';

import FeaturesBg from '../images/features-bg.png';
import FeaturesElement from '../images/features-element.png';

function Features() {
    const [tab, setTab] = useState(1);
    const { language } = useLanguage();
    const t = translations[language];

    const tabs = useRef(null);

    const heightFix = () => {
        if (tabs.current.children[tab]) {
            tabs.current.style.height = tabs.current.children[tab - 1].offsetHeight + 'px';
        }
    };

    useEffect(() => {
        heightFix();
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, [tab]);

    return (
        <section className="relative">
            {/* Section background (needs .relative class on parent and next sibling elements) */}
            <div className="absolute inset-0 bg-gray-100 pointer-events-none mb-16" aria-hidden="true"></div>
            <div className="absolute left-0 right-0 m-auto w-px p-px h-20 bg-gray-200 transform -translate-y-1/2"></div>

            <div className="relative max-w-6xl mx-auto px-4 sm:px-6">
                <div className="pt-12 md:pt-20">
                    {/* Section header */}
                    <div className="max-w-3xl mx-auto text-center pb-12 md:pb-16">
                        <h1 className="h2 mb-4">{t.exploreSolutions}</h1>
                        <p className="text-xl text-gray-600">
                            {t.featuresSubtitle}
                        </p>
                    </div>

                    {/* Section content */}
                    <div className="md:grid md:grid-cols-12 md:gap-6">
                        {/* Content */}
                        <div
                            className="max-w-xl md:max-w-none md:w-full mx-auto md:col-span-7 lg:col-span-6 md:mt-6"
                            data-aos="fade-right"
                        >
                            <div className="md:pr-4 lg:pr-12 xl:pr-16 mb-8">
                                <h3 className="h3 mb-3">{t.powerfulSuite}</h3>
                                <p className="text-xl text-gray-600">
                                    {t.featuresDescription}
                                </p>
                            </div>
                            {/* Tabs buttons */}
                            <div className="mb-8 md:mb-0">
                                <a
                                    className={`flex items-center text-lg p-5 rounded border transition duration-300 ease-in-out mb-3 ${
                                        tab !== 1
                                            ? 'bg-white shadow-md border-gray-200 hover:shadow-lg'
                                            : 'bg-gray-200 border-transparent'
                                    }`}
                                    href="#0"
                                    onClick={e => {
                                        e.preventDefault();
                                        setTab(1);
                                    }}
                                >
                                    <div>
                                        <div className="font-bold leading-snug tracking-tight mb-1">
                                            {t.tab1Title}
                                        </div>
                                        <div className="text-gray-600">
                                            {t.tab1Description}
                                        </div>
                                    </div>
                                    <div className="flex justify-center items-center w-8 h-8 bg-white rounded-full shadow flex-shrink-0 ml-3">
                                        <svg
                                            className="w-3 h-3 fill-current"
                                            viewBox="0 0 12 12"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path d="M11.953 4.29a.5.5 0 00-.454-.292H6.14L6.984.62A.5.5 0 006.12.173l-6 7a.5.5 0 00.379.825h5.359l-.844 3.38a.5.5 0 00.864.445l6-7a.5.5 0 00.075-.534z" />
                                        </svg>
                                    </div>
                                </a>
                                <a
                                    className={`flex items-center text-lg p-5 rounded border transition duration-300 ease-in-out mb-3 ${
                                        tab !== 2
                                            ? 'bg-white shadow-md border-gray-200 hover:shadow-lg'
                                            : 'bg-gray-200 border-transparent'
                                    }`}
                                    href="#0"
                                    onClick={e => {
                                        e.preventDefault();
                                        setTab(2);
                                    }}
                                >
                                    <div>
                                        <div className="font-bold leading-snug tracking-tight mb-1">
                                            {t.tab2Title}
                                        </div>
                                        <div className="text-gray-600">
                                            {t.tab2Description}
                                        </div>
                                    </div>
                                    <div className="flex justify-center items-center w-8 h-8 bg-white rounded-full shadow flex-shrink-0 ml-3">
                                        <svg
                                            className="w-3 h-3 fill-current"
                                            viewBox="0 0 12 12"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path d="M11.953 4.29a.5.5 0 00-.454-.292H6.14L6.984.62A.5.5 0 006.12.173l-6 7a.5.5 0 00.379.825h5.359l-.844 3.38a.5.5 0 00.864.445l6-7a.5.5 0 00.075-.534z" />
                                        </svg>
                                    </div>
                                </a>
                                <a
                                    className={`flex items-center text-lg p-5 rounded border transition duration-300 ease-in-out mb-3 ${
                                        tab !== 3
                                            ? 'bg-white shadow-md border-gray-200 hover:shadow-lg'
                                            : 'bg-gray-200 border-transparent'
                                    }`}
                                    href="#0"
                                    onClick={e => {
                                        e.preventDefault();
                                        setTab(3);
                                    }}
                                >
                                    <div>
                                        <div className="font-bold leading-snug tracking-tight mb-1">
                                            {t.tab3Title}
                                        </div>
                                        <div className="text-gray-600">
                                            {t.tab3Description}
                                        </div>
                                    </div>
                                    <div className="flex justify-center items-center w-8 h-8 bg-white rounded-full shadow flex-shrink-0 ml-3">
                                        <svg
                                            className="w-3 h-3 fill-current"
                                            viewBox="0 0 12 12"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path d="M11.953 4.29a.5.5 0 00-.454-.292H6.14L6.984.62A.5.5 0 006.12.173l-6 7a.5.5 0 00.379.825h5.359l-.844 3.38a.5.5 0 00.864.445l6-7a.5.5 0 00.075-.534z" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>

                        {/* Tabs items */}
                        <div className="max-w-xl md:max-w-none md:w-full mx-auto md:col-span-5 lg:col-span-6 mb-8 md:mb-0 md:order-1" data-aos="zoom-y-out" data-aos-delay="300">
                            <div className="relative">
                                {/* Background for tabs */}
                                <div className="absolute inset-0 bg-gradient-to-b from-blue-400 to-blue-600 my-4 md:my-0" style={{ transform: 'rotate(-1deg)' }}></div>

                                {/* Tabs background */}
                                <div className="relative h-full bg-gray-900 rounded" ref={tabs}>
                                    {/* Tab 1 */}
                                    <div className="relative flex flex-col h-full p-6 rounded shadow-2xl" data-aos="undefined">
                                        <div className="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 rounded" aria-hidden="true"></div>
                                        <div className="relative flex flex-col h-full">
                                            <svg className="w-16 h-16 p-1 -mt-1 mb-4" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                                <g fill="none" fillRule="evenodd">
                                                    <rect className="fill-current text-blue-600" width="64" height="64" rx="32" />
                                                    <g strokeWidth="2">
                                                        <path className="stroke-current text-blue-300" d="M34.514 35.429l2.057 2.285h8M20.571 26.286h5.715l2.057 2.285" />
                                                        <path className="stroke-current text-white" d="M20.571 37.714h5.715L36.57 26.286h8" />
                                                        <path className="stroke-current text-blue-300" strokeLinecap="square" d="M41.143 34.286l3.428 3.428-3.428 3.429" />
                                                        <path className="stroke-current text-white" strokeLinecap="square" d="M41.143 29.714l3.428-3.428-3.428-3.429" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <h4 className="h4 mb-2 text-white">Marketplace Integration</h4>
                                            <p className="text-lg text-gray-300 flex-grow">
                                                Connect with major Brazilian marketplaces including Mercado Livre, Amazon, B2W, Magazine Luiza, and more through our unified API.
                                            </p>
                                        </div>
                                    </div>

                                    {/* Tab 2 */}
                                    <div className="absolute inset-0 h-full p-6 rounded shadow-2xl" data-aos="undefined" style={{ display: 'none' }}>
                                        <div className="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 rounded" aria-hidden="true"></div>
                                        <div className="relative flex flex-col h-full">
                                            <svg className="w-16 h-16 p-1 -mt-1 mb-4" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                                <g fill="none" fillRule="evenodd">
                                                    <rect className="fill-current text-blue-600" width="64" height="64" rx="32" />
                                                    <g strokeWidth="2">
                                                        <path className="stroke-current text-blue-300" d="M34.514 35.429l2.057 2.285h8M20.571 26.286h5.715l2.057 2.285" />
                                                        <path className="stroke-current text-white" d="M20.571 37.714h5.715L36.57 26.286h8" />
                                                        <path className="stroke-current text-blue-300" strokeLinecap="square" d="M41.143 34.286l3.428 3.428-3.428 3.429" />
                                                        <path className="stroke-current text-white" strokeLinecap="square" d="M41.143 29.714l3.428-3.428-3.428-3.429" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <h4 className="h4 mb-2 text-white">Inventory Sync</h4>
                                            <p className="text-lg text-gray-300 flex-grow">
                                                Real-time inventory synchronization across all your sales channels to prevent overselling and maintain accurate stock levels.
                                            </p>
                                        </div>
                                    </div>

                                    {/* Tab 3 */}
                                    <div className="absolute inset-0 h-full p-6 rounded shadow-2xl" data-aos="undefined" style={{ display: 'none' }}>
                                        <div className="absolute inset-0 bg-gradient-to-b from-gray-800 to-gray-900 rounded" aria-hidden="true"></div>
                                        <div className="relative flex flex-col h-full">
                                            <svg className="w-16 h-16 p-1 -mt-1 mb-4" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                                <g fill="none" fillRule="evenodd">
                                                    <rect className="fill-current text-blue-600" width="64" height="64" rx="32" />
                                                    <g strokeWidth="2">
                                                        <path className="stroke-current text-blue-300" d="M34.514 35.429l2.057 2.285h8M20.571 26.286h5.715l2.057 2.285" />
                                                        <path className="stroke-current text-white" d="M20.571 37.714h5.715L36.57 26.286h8" />
                                                        <path className="stroke-current text-blue-300" strokeLinecap="square" d="M41.143 34.286l3.428 3.428-3.428 3.429" />
                                                        <path className="stroke-current text-white" strokeLinecap="square" d="M41.143 29.714l3.428-3.428-3.428-3.429" />
                                                    </g>
                                                </g>
                                            </svg>
                                            <h4 className="h4 mb-2 text-white">Analytics & Reporting</h4>
                                            <p className="text-lg text-gray-300 flex-grow">
                                                Comprehensive analytics and reporting tools to track performance across all marketplaces and optimize your sales strategy.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}

export default Features;
