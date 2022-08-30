import React from 'react';
import bdMap from '../../assets/image/home/bangladash-map.svg'


export const CoverageArea = () => {
    return (
        <div className='bg-green-600 p-10 my-10 '>
            <div className='container mx-auto text-white ' >
                <div className='grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 items-center' >
                    <div>
                        <img style={{ width: "50%" }} src={bdMap} alt="" />
                    </div>
                    <div>
                        <p className='text-4xl font-bold my-5' > Zoorun লজিস্টিকস সেবা সারাদেশে ৬৪ জেলা এবং ৪৯৩ উপজেলা জুড়ে বিস্তৃত</p>
                        <p className='text-xl font-semibold my-5'>আপনার যেকোনো লজিস্টিকস প্রয়োজনের জন্য আমরা নিশ্চিত করি দেশজুড়ে সবচেয়ে দ্রুতগতির সেবা</p>
                        <button className='bg-green-500 text-white w-72 py-3 font-bold my-4 rounded' >কভারেজ এলাকা দেখুন </button>
                    </div>

                </div>

            </div>
        </div>
    );
};
