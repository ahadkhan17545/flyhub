import React from 'react';
import { useLanguage } from '../utils/LanguageContext';
import { translations } from '../utils/translations';

function Testimonials() {
    const { language } = useLanguage();
    const t = translations[language];

    return (
        <section>
            <div className="max-w-6xl mx-auto px-4 sm:px-6">
                <div className="py-12 md:py-20">
                    {/* Section header */}
                    <div className="max-w-3xl mx-auto text-center pb-12 md:pb-20">
                        <h2 className="h2 mb-4">{t.testimonialsTitle}</h2>
                        <p className="text-xl text-gray-600">
                            {t.testimonialsSubtitle}
                        </p>
                    </div>

                    {/* Testimonials */}
                    <div className="max-w-sm mx-auto grid gap-8 lg:grid-cols-3 lg:gap-6 lg:max-w-none">
                        {/* 1st testimonial */}
                        <div className="flex flex-col h-full p-6 bg-gray-50" data-aos="fade-up">
                            <div>
                                <div className="relative inline-flex flex-col justify-center">
                                    <svg
                                        className="absolute inset-0 transform scale-150"
                                        width="143"
                                        height="32"
                                        viewBox="0 0 143 32"
                                        style={{ top: '0.3125rem' }}
                                    >
                                        <defs>
                                            <linearGradient
                                                id="testimonial-1"
                                                x1="0%"
                                                y1="0%"
                                                x2="100%"
                                                y2="0%"
                                            >
                                                <stop stopColor="#4F46E5" offset="0%" />
                                                <stop stopColor="#7C3AED" offset="100%" />
                                            </linearGradient>
                                        </defs>
                                        <path
                                            d="M42.766 20.226a1.131 1.131 0 00-.447.676 5.766 5.766 0 01-4.58 4.58 1.131 1.131 0 00-.676.447l-3.495 3.495a1.131 1.131 0 01-1.695 0l-3.495-3.495a1.131 1.131 0 00-.676-.447 5.766 5.766 0 01-4.58-4.58 1.131 1.131 0 00-.447-.676L11.226 13.28a1.131 1.131 0 010-1.695l3.495-3.495a1.131 1.131 0 00.447-.676 5.766 5.766 0 014.58-4.58 1.131 1.131 0 00.676-.447l3.495-3.495a1.131 1.131 0 011.695 0l3.495 3.495a1.131 1.131 0 00.676.447 5.766 5.766 0 014.58 4.58 1.131 1.131 0 00.447.676l3.495 3.495a1.131 1.131 0 010 1.695l-3.495 3.495z"
                                            fill="url(#testimonial-1)"
                                        />
                                    </svg>
                                    <div className="relative">
                                        <svg
                                            className="mb-3"
                                            width="40"
                                            height="32"
                                            viewBox="0 0 40 32"
                                            fill="currentColor"
                                        >
                                            <path d="M10.766 20.226a1.131 1.131 0 00-.447.676 5.766 5.766 0 01-4.58 4.58 1.131 1.131 0 00-.676.447l-3.495 3.495a1.131 1.131 0 01-1.695 0l-3.495-3.495a1.131 1.131 0 00-.676-.447 5.766 5.766 0 01-4.58-4.58 1.131 1.131 0 00-.447-.676L-1.226 13.28a1.131 1.131 0 010-1.695l3.495-3.495a1.131 1.131 0 00.447-.676 5.766 5.766 0 014.58-4.58 1.131 1.131 0 00.676-.447L7.28.385a1.131 1.131 0 011.695 0l3.495 3.495a1.131 1.131 0 00.676.447 5.766 5.766 0 014.58 4.58 1.131 1.131 0 00.447.676l3.495 3.495a1.131 1.131 0 010 1.695l-3.495 3.495z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <blockquote className="text-lg text-gray-900 flex-grow">
                                {t.testimonial1.quote}
                            </blockquote>
                            <div className="text-gray-700 font-medium mt-6 pt-5 border-t border-gray-200">
                                <cite className="text-gray-900 not-italic">
                                    {t.testimonial1.author}
                                </cite>
                                <span className="text-gray-500"> · </span>
                                <span className="text-gray-500">{t.testimonial1.role}</span>
                            </div>
                        </div>

                        {/* 2nd testimonial */}
                        <div className="flex flex-col h-full p-6 bg-gray-50" data-aos="fade-up" data-aos-delay="100">
                            <div>
                                <div className="relative inline-flex flex-col justify-center">
                                    <svg
                                        className="absolute inset-0 transform scale-150"
                                        width="143"
                                        height="32"
                                        viewBox="0 0 143 32"
                                        style={{ top: '0.3125rem' }}
                                    >
                                        <defs>
                                            <linearGradient
                                                id="testimonial-2"
                                                x1="0%"
                                                y1="0%"
                                                x2="100%"
                                                y2="0%"
                                            >
                                                <stop stopColor="#4F46E5" offset="0%" />
                                                <stop stopColor="#7C3AED" offset="100%" />
                                            </linearGradient>
                                        </defs>
                                        <path
                                            d="M42.766 20.226a1.131 1.131 0 00-.447.676 5.766 5.766 0 01-4.58 4.58 1.131 1.131 0 00-.676.447l-3.495 3.495a1.131 1.131 0 01-1.695 0l-3.495-3.495a1.131 1.131 0 00-.676-.447 5.766 5.766 0 01-4.58-4.58 1.131 1.131 0 00-.447-.676L11.226 13.28a1.131 1.131 0 010-1.695l3.495-3.495a1.131 1.131 0 00.447-.676 5.766 5.766 0 014.58-4.58 1.131 1.131 0 00.676-.447l3.495-3.495a1.131 1.131 0 011.695 0l3.495 3.495a1.131 1.131 0 00.676.447 5.766 5.766 0 014.58 4.58 1.131 1.131 0 00.447.676l3.495 3.495a1.131 1.131 0 010 1.695l-3.495 3.495z"
                                            fill="url(#testimonial-2)"
                                        />
                                    </svg>
                                    <div className="relative">
                                        <svg
                                            className="mb-3"
                                            width="40"
                                            height="32"
                                            viewBox="0 0 40 32"
                                            fill="currentColor"
                                        >
                                            <path d="M10.766 20.226a1.131 1.131 0 00-.447.676 5.766 5.766 0 01-4.58 4.58 1.131 1.131 0 00-.676.447l-3.495 3.495a1.131 1.131 0 01-1.695 0l-3.495-3.495a1.131 1.131 0 00-.676-.447 5.766 5.766 0 01-4.58-4.58 1.131 1.131 0 00-.447-.676L-1.226 13.28a1.131 1.131 0 010-1.695l3.495-3.495a1.131 1.131 0 00.447-.676 5.766 5.766 0 014.58-4.58 1.131 1.131 0 00.676-.447L7.28.385a1.131 1.131 0 011.695 0l3.495 3.495a1.131 1.131 0 00.676.447 5.766 5.766 0 014.58 4.58 1.131 1.131 0 00.447.676l3.495 3.495a1.131 1.131 0 010 1.695l-3.495 3.495z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <blockquote className="text-lg text-gray-900 flex-grow">
                                {t.testimonial2.quote}
                            </blockquote>
                            <div className="text-gray-700 font-medium mt-6 pt-5 border-t border-gray-200">
                                <cite className="text-gray-900 not-italic">
                                    {t.testimonial2.author}
                                </cite>
                                <span className="text-gray-500"> · </span>
                                <span className="text-gray-500">{t.testimonial2.role}</span>
                            </div>
                        </div>

                        {/* 3rd testimonial */}
                        <div className="flex flex-col h-full p-6 bg-gray-50" data-aos="fade-up" data-aos-delay="200">
                            <div>
                                <div className="relative inline-flex flex-col justify-center">
                                    <svg
                                        className="absolute inset-0 transform scale-150"
                                        width="143"
                                        height="32"
                                        viewBox="0 0 143 32"
                                        style={{ top: '0.3125rem' }}
                                    >
                                        <defs>
                                            <linearGradient
                                                id="testimonial-3"
                                                x1="0%"
                                                y1="0%"
                                                x2="100%"
                                                y2="0%"
                                            >
                                                <stop stopColor="#4F46E5" offset="0%" />
                                                <stop stopColor="#7C3AED" offset="100%" />
                                            </linearGradient>
                                        </defs>
                                        <path
                                            d="M42.766 20.226a1.131 1.131 0 00-.447.676 5.766 5.766 0 01-4.58 4.58 1.131 1.131 0 00-.676.447l-3.495 3.495a1.131 1.131 0 01-1.695 0l-3.495-3.495a1.131 1.131 0 00-.676-.447 5.766 5.766 0 01-4.58-4.58 1.131 1.131 0 00-.447-.676L11.226 13.28a1.131 1.131 0 010-1.695l3.495-3.495a1.131 1.131 0 00.447-.676 5.766 5.766 0 014.58-4.58 1.131 1.131 0 00.676-.447l3.495-3.495a1.131 1.131 0 011.695 0l3.495 3.495a1.131 1.131 0 00.676.447 5.766 5.766 0 014.58 4.58 1.131 1.131 0 00.447.676l3.495 3.495a1.131 1.131 0 010 1.695l-3.495 3.495z"
                                            fill="url(#testimonial-3)"
                                        />
                                    </svg>
                                    <div className="relative">
                                        <svg
                                            className="mb-3"
                                            width="40"
                                            height="32"
                                            viewBox="0 0 40 32"
                                            fill="currentColor"
                                        >
                                            <path d="M10.766 20.226a1.131 1.131 0 00-.447.676 5.766 5.766 0 01-4.58 4.58 1.131 1.131 0 00-.676.447l-3.495 3.495a1.131 1.131 0 01-1.695 0l-3.495-3.495a1.131 1.131 0 00-.676-.447 5.766 5.766 0 01-4.58-4.58 1.131 1.131 0 00-.447-.676L-1.226 13.28a1.131 1.131 0 010-1.695l3.495-3.495a1.131 1.131 0 00.447-.676 5.766 5.766 0 014.58-4.58 1.131 1.131 0 00.676-.447L7.28.385a1.131 1.131 0 011.695 0l3.495 3.495a1.131 1.131 0 00.676.447 5.766 5.766 0 014.58 4.58 1.131 1.131 0 00.447.676l3.495 3.495a1.131 1.131 0 010 1.695l-3.495 3.495z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <blockquote className="text-lg text-gray-900 flex-grow">
                                {t.testimonial3.quote}
                            </blockquote>
                            <div className="text-gray-700 font-medium mt-6 pt-5 border-t border-gray-200">
                                <cite className="text-gray-900 not-italic">
                                    {t.testimonial3.author}
                                </cite>
                                <span className="text-gray-500"> · </span>
                                <span className="text-gray-500">{t.testimonial3.role}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    );
}

export default Testimonials;
