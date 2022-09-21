import React from 'react';
import { GiTruck, GiDeliveryDrone } from "react-icons/gi";
import { FaSms, FaHandHoldingUsd } from "react-icons/fa";
import { BsCashCoin } from "react-icons/bs";
import { TbShoppingCartPlus, TbTruckDelivery } from "react-icons/tb";

export const LogisticsPartner = () => {
    return (
        <div className='my-20 container mx-auto'>
            <div >
                <p className='text-lg sm:text-lg md:text-3xl lg:text-3xl font-bold text-center'>আপনার বিশস্ত কুড়িয়ার পার্টনার হিসেবে ZOORUN -কে বেছে নিন</p>

                <div className="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-5 mx-5">
                    <div className=''>
                        <div className='flex items-center justify-center'>
                            <GiTruck size={60} color={'#34a34b'} />
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-lg sm:text-lg md:text-xl lg:text-xl font-bold ' >সর্বোচ্চ ৭২ ঘন্টায় ডেলিভারির নিশ্চয়তা</p>
                            <p className='text-md text-gray-900 mt-5' >যেকোন সাইজের পার্সেল দেশের যেকোন জায়গায় পৌঁছাবে মাত্র ৭২ ঘন্টায়</p>
                        </div>
                    </div>
                    <div className=''>
                        <div className='flex items-center justify-center'>
                            <TbTruckDelivery size={60} color={'#34a34b'} />
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-lg sm:text-lg md:text-xl lg:text-xl font-bold ' >নিকটস্থ স্থানে পিকআপ ও ডেলিভারি সুবিধা</p>
                            <p className='text-md text-gray-900 mt-5' >আপনার প্রয়োজন অনুযায়ী বেছে নিন আপনার নিকটস্থ স্থানে পিকআপ সুবিধা এবং সেইসাথে কাস্টমারের সুবিধামত ডেলিভারী প্রক্রিয়া</p>
                        </div>
                    </div>
                    <div className=''>
                        <div className='flex items-center justify-center'>
                            <FaSms size={60} color={'#34a34b'} />
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-lg sm:text-lg md:text-xl lg:text-xl font-bold' >এসএমএস আপডেট</p>
                            <p className='text-md text-gray-900 mt-5' >ওটিপির সুবিদার্থে আপনার কাস্টমার পাবে আসল পণ্যের নিশ্চয়তা</p>
                        </div>
                    </div>
                    <div className=''>
                        <div className='flex items-center justify-center'>

                            <FaHandHoldingUsd size={60} color={'#34a34b'} />
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-lg sm:text-lg md:text-xl lg:text-xl font-bold ' >২৪ ঘন্টায় পেমেন্ট</p>
                            <p className='text-md text-gray-900 mt-5' >কাস্টমারের হাতে প্রোডাক্ট পৌছে দেবার পরবর্তি ২৪ ঘন্টার মধ্যেই পেয়ে যাচ্ছেন পণ্যের গ্যারান্টেড পেমেন্ট</p>
                        </div>
                    </div>
                    {/* <div className=''>
                        <div className='flex items-center justify-center'>
                            <BsCashCoin size={60} color={'#34a34b'} />
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-lg sm:text-lg md:text-xl lg:text-xl font-bold' >সেরা ক্যাশ অন ডেলিভারি রেট</p>
                            <p className='text-md text-gray-900 mt-5' >যেকোন সাইজের ভেহিকেল দেশের যেকোন জায়গায় পৌঁছাবে মাত্র তিন ঘন্টায়</p>
                        </div>
                    </div> */}
                    {/* <div className=''>
                        <div className='flex items-center justify-center'>
                            <TbShoppingCartPlus size={60} color={'#34a34b'} />
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-lg sm:text-lg md:text-xl lg:text-xl font-bold ' >সিকিউর হ্যান্ডলিং</p>
                            <p className='text-md text-gray-900 mt-5' >যেকোন সাইজের ভেহিকেল দেশের যেকোন জায়গায় পৌঁছাবে মাত্র তিন ঘন্টায়</p>
                        </div>
                    </div> */}


                </div>
            </div>
        </div>
    );
};
