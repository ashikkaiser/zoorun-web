import React from 'react';
import { GiTruck, GiDeliveryDrone } from "react-icons/gi";
import { FaSms, FaHandHoldingUsd } from "react-icons/fa";
import { BsCashCoin } from "react-icons/bs";
import { TbShoppingCartPlus, TbTruckDelivery } from "react-icons/tb";

export const LogisticsPartner = () => {
    return (
        <div className='my-20 container mx-auto'>
            <div >
                <p className='text-3xl font-bold text-center '>আপনার লজিস্টিক পার্টনার হিসেবে ZOORUN বেছে নিন</p>

                <div className="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 mt-5 mx-5">
                    <div className=''>
                        <div className='flex items-center justify-center'>
                            <GiTruck size={60} color={'#34a34b'} />
                            {/* <img className='w-24' src="/assets/image/home/logisticks/avail-any-vehicle.png" alt="" /> */}
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-xl font-bold ' >৩ দিনে ডেলিভারি গ্যারান্টিড</p>
                            <p className='text-md text-gray-900 mt-5' >যেকোন সাইজের ভেহিকেল দেশের যেকোন জায়গায় পৌঁছাবে মাত্র তিন ঘন্টায়</p>
                        </div>
                    </div>
                    <div className=''>
                        <div className='flex items-center justify-center'>
                            <TbTruckDelivery size={60} color={'#34a34b'} />
                            {/* <img className='w-24' src="/assets/image/home/logisticks/avail-any-vehicle.png" alt="" /> */}
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-xl font-bold ' >ডোরস্টেপ পিকআপ ও ডেলিভারি</p>
                            <p className='text-md text-gray-900 mt-5' >আপনার ব্যবসার প্রয়োজন অনুযায়ী বেছে নিন ফুল ট্রাকলোড (এফটিএল) অথবা লেস দ্যান ট্রাকলোড (এলটিএল) ফ্রেইট সলিউশন।</p>
                        </div>
                    </div>
                    <div className=''>
                        <div className='flex items-center justify-center'>
                            <FaSms size={60} color={'#34a34b'} />
                            {/* <img className='w-24' src="/assets/image/home/logisticks/avail-any-vehicle.png" alt="" /> */}
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-xl font-bold ' >এসএমএস আপডেট</p>
                            <p className='text-md text-gray-900 mt-5' >যেকোন সাইজের ভেহিকেল দেশের যেকোন জায়গায় পৌঁছাবে মাত্র তিন ঘন্টায়</p>
                        </div>
                    </div>
                    <div className=''>
                        <div className='flex items-center justify-center'>

                            <FaHandHoldingUsd size={60} color={'#34a34b'} />
                            {/* <img className='w-24' src="/assets/image/home/logisticks/avail-any-vehicle.png" alt="" /> */}
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-xl font-bold ' >পরের দিনই পেমেন্ট</p>
                            <p className='text-md text-gray-900 mt-5' >যেকোন সাইজের ভেহিকেল দেশের যেকোন জায়গায় পৌঁছাবে মাত্র তিন ঘন্টায়</p>
                        </div>
                    </div>
                    <div className=''>
                        <div className='flex items-center justify-center'>
                            <BsCashCoin size={60} color={'#34a34b'} />
                            {/* <img className='w-24' src="/assets/image/home/logisticks/avail-any-vehicle.png" alt="" /> */}
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-xl font-bold ' >সেরা ক্যাশ অন ডেলিভারি রেট</p>
                            <p className='text-md text-gray-900 mt-5' >যেকোন সাইজের ভেহিকেল দেশের যেকোন জায়গায় পৌঁছাবে মাত্র তিন ঘন্টায়</p>
                        </div>
                    </div>
                    <div className=''>
                        <div className='flex items-center justify-center'>
                            <TbShoppingCartPlus size={60} color={'#34a34b'} />
                            {/* <img className='w-24' src="/assets/image/home/logisticks/avail-any-vehicle.png" alt="" /> */}
                        </div>

                        <div className='my-2 p-1 text-center mt-6'>
                            <p className='text-xl font-bold ' >সিকিউর হ্যান্ডলিং</p>
                            <p className='text-md text-gray-900 mt-5' >যেকোন সাইজের ভেহিকেল দেশের যেকোন জায়গায় পৌঁছাবে মাত্র তিন ঘন্টায়</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    );
};
