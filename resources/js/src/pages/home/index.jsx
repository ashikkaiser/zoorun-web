import React from 'react';
import { Banner, ClientFeedback, CoverageArea, DeliveryCalculator, EnjoyDeliveryCharge, Header, Layout, LogisticsPartner, Service } from '../../components';

export const Home = () => {
    return (
        <div>
            <Banner />
            <Service />
            <LogisticsPartner />
            <CoverageArea />
            <DeliveryCalculator />
            {/* <ClientFeedback /> */}

            {/* <EnjoyDeliveryCharge /> */}



            <div className='container mx-auto my-10 px-5'>
                <h1 className='text-center text-2xl font-bold'>আমাদের মার্চেন্ট </h1>
                <div className='flex items-center flex-wrap justify-center gap-5' >
                    <p className='text-gray-400' >TOP Merchant</p>
                    <img width={150} className='grayscale hover:grayscale-0' src="/assets/image/merchant/BD Beponi.png" alt="BD Beponi" />

                    <img width={150} className='grayscale hover:grayscale-0' src="/assets/image/merchant/Priyoshop Logo.png" alt="Priyoshop" />
                    <img width={150} className='grayscale hover:grayscale-0' src="/assets/image/merchant/Q Comm.png" alt="Q Comm" />
                    <img width={100} className='grayscale hover:grayscale-0' src="/assets/image/merchant/FR Gadget View.png" alt="FR Gadget" />
                    <img width={100} className='grayscale hover:grayscale-0' src="/assets/image/merchant/Pro Pic.jpg" alt="Pro Pic" />

                </div>
            </div>




        </div>




    );
};
