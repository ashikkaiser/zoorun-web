import React from 'react';

export const Service = () => {
    return (
        <div className='my-20 container mx-auto'>
            <p className='text-3xl font-bold text-center ' >সার্ভিস সমূহ</p>

            <div className="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-6 mt-5 mx-5">
                <div>
                    <img src="/assets/image/home/service/parcel-delivery.webp" alt="" />
                    <div className='my-2 p-1'>
                        <p className='text-xl font-bold' >পার্সেল ডেলিভারি</p>
                        <p className='text-md text-gray-500' >ব্যক্তিগত, ছোট ব্যবসা এবং কর্পোরেটদের জন্য ফার্স্ট-মাইল পিকআপ এবং লাস্ট মাইল ডেলিভারি সেবা</p>
                    </div>
                </div>
                <div>
                    <img src="/assets/image/home/service/bulk-shipment.webp" alt="" />
                    <div className='my-2 p-1'>
                        <p className='text-xl font-bold' >বাল্ক শিপমেন্ট</p>
                        <p className='text-md text-gray-500' >বড় আইটেম এবং বড় সংখ্যক ডেলিভারির বিশেষ সমাধান</p>
                    </div>
                </div>
                <div>
                    <img src="/assets/image/home/service/line-haul.webp" alt="" />
                    <div className='my-2 p-1'>
                        <p className='text-xl font-bold' >লাইন হল</p>
                        <p className='text-md text-gray-500' >এফটিএল (পুরো ট্রাকলোড) ও এলটিএল (আংশিক ট্রাকলোড) সহ মালামাল পরিবহনের সকল সমাধান</p>
                    </div>
                </div>
                <div>
                    <img src="/assets/image/home/service/warehouse.webp" alt="" />
                    <div className='my-2 p-1'>
                        <p className='text-xl font-bold' >ওয়্যারহাউজ</p>
                        <p className='text-md text-gray-500' >সংরক্ষন, বাছাই এবং প্রক্রিয়াজাতকরণের পরিপূর্ণ সমাধান</p>
                    </div>
                </div>
                <div>
                    <img src="/assets/image/home/service/truck-rent.webp" alt="" />
                    <div className='my-2 p-1'>
                        <p className='text-xl font-bold' >ট্রাক ভাড়া</p>
                        <p className='text-md text-gray-500' >খোলা ট্রাক এবং কাভার্ড ভ্যান দেশের যে কোন জায়গায় যে কোন সময়</p>
                    </div>
                </div>
                <div>
                    <img src="/assets/image/home/service/load-unload.webp" alt="" />
                    <div className='my-2 p-1'>
                        <p className='text-xl font-bold' >লোড-আনলোড</p>
                        <p className='text-md text-gray-500' >ইন্ডাস্ট্রি-অনুযায়ী ফ্যাক্টরি, প্রজেক্ট এবং বন্দরগুলোতে লোডিং-আনলোডিংয়ের সুবিধা</p>
                    </div>
                </div>
                <div>
                    <img src="/assets/image/home/service/logistics-service.webp" alt="" />
                    <div className='my-2 p-1'>
                        <p className='text-xl font-bold' >লজিস্টিকস সেবা</p>
                        <p className='text-md text-gray-500' >লজিস্টিকস সংক্রান্ত যে কোন সমস্যার সমাধানে অভিজ্ঞ টিমের সহায়তা</p>
                    </div>
                </div>
                <div>
                    <img src="/assets/image/home/service/customised-solutions.webp" alt="" />
                    <div className='my-2 p-1'>
                        <p className='text-xl font-bold' >কাস্টমাইজ সমাধান</p>
                        <p className='text-md text-gray-500' >আপনার ব্যবসায়িক ধরনের প্রয়োজন বুঝে কাস্টমাইজড সল্যুশন</p>
                    </div>
                </div>


            </div>

        </div>
    );
};
