import React from 'react';
import { LogisticsPartner } from '../../components';
import { ContactUs, EnterpriseBanner, MerchantStory, SortBanner, Vehicles } from '../../components/enterprise';

export const Enterprise = () => {
    return (
        <>
            <EnterpriseBanner />
            <LogisticsPartner />
            <Vehicles />
            <MerchantStory />
            <ContactUs />
            <SortBanner />
        </>




    );
};
