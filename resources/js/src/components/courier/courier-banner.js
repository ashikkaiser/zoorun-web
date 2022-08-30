import React from 'react';
import bannerImage from '../../assets/image/courier/banner.jpeg'
import { IoIosArrowForward } from 'react-icons/io'

export const CourierBanner = () => {
    return (
        <div className=''>
            <div style={{
                backgroundImage: `url(${bannerImage})`,
                backgroundPosition: 'center',
                backgroundSize: 'cover',
                backgroundRepeat: 'no-repeat',
            }}>

                <div className=" py-10 sm:py-10 md:py-20 lg:py-20 max-w-7xl mx-auto px-4 sm:px-6">
                    <div className=" ">
                        <div className='w-full sm:w-full md:w-2/5 lg:w-2/5'>
                            <p className='text-4xl font-bold leading-relaxed	' >দেশজুড়ে দ্রুততম ডেলিভারি <br /> সেবা পেতে Zoorun <br /> কুরিয়ারের সাথে থাকুন!</p>
                            <button className='bg-green-500 text-white py-3 font-bold my-4 rounded px-5 flex items-center gap-3' ><span>বুথের লোকেশনগুলো দেখুন </span><span><IoIosArrowForward /> </span></button>
                        </div>


                    </div>

                </div>
            </div>
            <div className='bg-black'>
                <div className='container mx-auto py-10'>
                    <div className='grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 items-center px-5 sm:px-5 md:px-0 lg:px-0'>
                        <div>
                            <p className='text-white text-md font-medium'>আমাদের অনলাইন ট্র্যাকিং সার্ভিস দিয়ে কুরিয়ার ট্র্যাক করুন</p>
                        </div>
                        <div className=" ">
                            <div className=" flex rounded-md border-r-0">
                                <input type="text" name="company-website" id="company-website" className="border focus:ring-green-500 focus:border-green-500 focus:border flex-1 block w-full   rounded-l sm:text-sm border-gray-300 px-5 " placeholder="পার্সেল আইডি" />
                                <span className="inline-flex items-center px-10 py-2 rounded-r-md border-l-0 border-gray-300 bg-green-600  text-lg text-white"> ট্র্যাক</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    );
};
