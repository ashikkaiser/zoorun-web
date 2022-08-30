import React from 'react';
import { Banner, ClientFeedback, CoverageArea, DeliveryCalculator, EnjoyDeliveryCharge, Faq, Header, Layout, LogisticsPartner, Service } from '../../components';

export const Home = () => {
    return (
        <>
            <Banner />
            <Service />
            <LogisticsPartner />
            <CoverageArea />
            <DeliveryCalculator />
            <ClientFeedback />
            <Faq />
            <EnjoyDeliveryCharge />
        </>




    );
};
