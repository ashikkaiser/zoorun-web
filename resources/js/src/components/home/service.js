import React from 'react';

export const Service = () => {
    return (
        <div className='my-20 container mx-auto'>
            <p className='text-lg sm:text-lg md:text-3xl lg:text-3xl font-bold text-center ' >সার্ভিস সমূহ</p>

            <div className="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-6 mt-5 mx-5">
                <div>
                    {/* <img src="/assets/image/home/service/delivery.jpeg" alt="" /> */}
                    <div className='my-2 p-1'>
                        <p className='text-lg sm:text-lg md:text-xl lg:text-xl font-bold' >পার্সেল ডেলিভারি</p>
                        <p className='text-md text-gray-500' >ব্যক্তিগত, ছোট ব্যবসা এবং কর্পোরেট অফিসের জন্য ফার্স্টার ডেলিভারি সেবা</p>
                    </div>
                </div>
                <div>
                    {/* <img src="/assets/image/home/service/shipment-1.png" alt="" /> */}
                    <div className='my-2 p-1'>
                        <p className='text-lg sm:text-lg md:text-xl lg:text-xl font-bold' >বাল্ক শিপমেন্ট</p>
                        <p className='text-md text-gray-500' >বড় থেকে ছোট যেকোন বাল্ক আইটেম এর ক্ষেত্রে ডেলিভারির বিশেষ সমাধান </p>
                    </div>
                </div>
                <div>
                    {/* <img src="/assets/image/home/service/line-haul.webp" alt="" /> */}
                    <div className='my-2 p-1'>
                        <p className='text-lg sm:text-lg md:text-xl lg:text-xl font-bold' >ওয়্যারহাউজ</p>
                        <p className='text-md text-gray-500' >আমাদের ওয়্যারহাউজে পণ্য সংরক্ষন, বাছাই এবং প্রক্রিয়াজাতকরণের মাধ্যমে পরিপূর্ণ সমাধান প্রদান</p>
                    </div>
                </div>
                <div>
                    {/* <img src="/assets/image/home/service/warehouse.webp" alt="" /> */}
                    <div className='my-2 p-1'>
                        <p className='text-lg sm:text-lg md:text-xl lg:text-xl font-bold' >বিবিধ সমাধান</p>
                        <p className='text-md text-gray-500' >আপনার ব্যবসায়িক ধরনের প্রয়োজন বুঝে পরিপূর্ণ সমাধানের ব্যবস্থা</p>
                    </div>
                </div>






            </div>

        </div>
    );
};
