import React from 'react';

export const CourierSupport = () => {
    return (
        <div className='max-w-7xl mx-auto px-4 sm:px-6 my-10 sm:my-10 md:my-20 lg:my-20'>
            <div className="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-6 mt-5 mx-5">
                <div className=''>
                    <div className='flex items-center justify-center'>
                        <img className='w-24' src="/assets/image/courier/home-del.png" alt="" />
                        {/* <img className='w-24' src="/assets/image/home/logisticks/avail-any-vehicle.png" alt="" /> */}
                    </div>

                    <div className='my-2 p-1 text-center mt-6'>
                        <p className='text-xl font-bold ' >দেশজুড়ে হোম ডেলিভারি সেবা</p>
                        <p className='text-md text-gray-900 mt-5' >যেখানেই থাকুন, কুরিয়ার পৌছে যাবে আপনার দোরগোড়ায়</p>
                    </div>
                </div>
                <div className=''>
                    <div className='flex items-center justify-center'>
                        <img className='w-24' src="/assets/image/home/logisticks/avail-any-vehicle.png" alt="" />
                    </div>

                    <div className='my-2 p-1 text-center mt-6'>
                        <p className='text-xl font-bold ' >কম সময়ে কন্ডিশন মূল্য পরিশোধ</p>
                        <p className='text-md text-gray-900 mt-5' >ডেলিভারির পরদিনের মাঝে কন্ডিশন মূল্য পাবার নিশ্চয়তা</p>
                    </div>
                </div>
                <div className=''>
                    <div className='flex items-center justify-center'>
                        <img className='w-24' src="/assets/image/home/logisticks/avail-any-vehicle.png" alt="" />
                    </div>

                    <div className='my-2 p-1 text-center mt-6'>
                        <p className='text-xl font-bold ' >লাইভ ট্র্যাকিং</p>
                        <p className='text-md text-gray-900 mt-5' >ঘরে বসেই দেখুন আপনার কুরিয়ারের বর্তমান অবস্থান</p>
                    </div>
                </div>
                <div className=''>
                    <div className='flex items-center justify-center'>
                        <img className='w-24' src="/assets/image/home/logisticks/avail-any-vehicle.png" alt="" />
                    </div>

                    <div className='my-2 p-1 text-center mt-6'>
                        <p className='text-xl font-bold ' >এসএমএস আপডেট</p>
                        <p className='text-md text-gray-900 mt-5' >ডেলিভারি এলাকায় কুরিয়ার পৌছালে পাবেন নিবন্ধিত মোবাইল নম্বরে এসএমএস আপডেট</p>
                    </div>
                </div>


            </div>
        </div>
    );
};
