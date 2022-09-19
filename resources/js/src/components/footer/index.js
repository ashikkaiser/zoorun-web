import React from 'react';
import googlePlay from '../../assets/image/googleplay.svg'
import mySvg from '../../assets/image/linkedInicon.svg'
import facebook from '../../assets/image/facebook.svg'
import youtube from '../../assets/image/youtube.svg'

export const Footer = () => {

    const d = new Date();
    let year = d.getFullYear();

    return (
        <div className='bg-green-600' >
            <div className="max-w-7xl mx-auto px-4 sm:px-6 py-10 text-gray-200">
                <div className="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-6">
                    <div className="p-4 col-span-2" >
                        <img className='my-4' src="/assets/image/logo.png" alt="" />
                        <p className='my-4'>দ্রুততম সল্যুশনের জন্য Zoorun অ্যাপটি ডাউনলোড করুন</p>
                        <a target={'_blank'} href="/">
                            <img className='h-16' src={googlePlay} alt="" />
                        </a>
                    </div>

                    <div className=" p-4 ">
                        <p className='text-xl font-semibold' >গুরুত্বপূর্ণ লিংক</p>
                        <div className=" mt-4 ">
                            <a href="/">
                                <p className='text-md mb-2' >কুরিয়ার</p>
                            </a>
                            <a href="/">
                                <p className='text-md mb-2' >এন্টারপ্রাইজ</p>
                            </a>
                            <a href="/">
                                <p className='text-md mb-2' >কভারেজ এরিয়া</p>
                            </a>
                            <a href="/">
                                <p className='text-md mb-2' >প্রাইভেসী পলিসি</p>
                            </a>
                            <a href="/">
                                <p className='text-md mb-2' >FAQs</p>
                            </a>
                        </div>
                    </div>
                    <div className=" p-4">
                        <p className='text-xl font-semibold' >যোগাযোগ</p>
                        <div className=" mt-4 ">
                            <a href="/">
                                <p className='text-md mb-2' >House: 558 (5th Floor), Kazipara Bus Stop, Kazipara, Mirpur, Dhaka - 1216</p>
                            </a>
                            <a href="/">
                                <p className='text-md mb-2' >+8801324411649</p>
                            </a>
                            <a href="/">
                                <p className='text-md mb-2' >admin@zoorunbd.com</p>
                            </a>

                        </div>
                    </div>
                    <div className=" p-4">
                        <p className='text-xl font-semibold' >সংযুক্ত হন</p>
                        <div className=" mt-4 flex gap-2">
                            <a href="/">
                                <img className='h-6' src={facebook} alt="" />
                            </a>
                            <a href="/">
                                <img className='h-6' src={mySvg} alt="" />
                            </a>
                            <a href="/">
                                <img className='h-6' src={youtube} alt="" />
                            </a>

                        </div>
                        <p className='mt-4' > &#169; Zoorun {year}. All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    );
};
