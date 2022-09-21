import React from 'react';
import { Link } from 'react-router-dom';
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
                        <p className='text-lg sm:text-lg md:text-4xl lg:text-4xl font-bold  my-5' > Zoorun Courier সেবা সারাদেশ জুড়ে বিস্তৃত</p>
                        <p className='text-md sm:text-md lg:text-xl md:text-xl font-semibold my-5'>আপনার পণ্য কুড়িয়ার সংক্রান্ত যেকোনো সমাধানে শুধুমাত্র আমরাই  নিশ্চিত করছি সবচেয়ে দ্রুতগতির সেবা</p>

                        <Link to={'/coverage-area'}>
                            <button className='bg-green-500 text-white w-72 py-3 font-bold my-4 rounded' >কভারেজ এলাকা দেখুন </button>

                        </Link>

                    </div>

                </div>

            </div>
        </div>
    );
};
