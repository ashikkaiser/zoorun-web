import React from 'react';

export const SortBanner = () => {
    return (
        <div className='container mx-auto bg-black flex justify-center my-20' >
            <div className='grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6  w-3/4 py-14 items-center'>
                <div className=''>
                    <p className='text-3xl font-bold text-white  '>Zoorun পার্টনার হোন আজই</p>
                    <p className='text-md font-bold text-white mt-5 '>সাইন-আপ করুন করুন মাত্র দুই মিনিটে</p>
                </div>
                <div className=' flex justify-end'>
                    <button type='submit' className='bg-green-500 text-white w-2/4	 py-3 font-bold   rounded' >সাবমিট</button>
                </div>

            </div>
        </div>
    );
};
