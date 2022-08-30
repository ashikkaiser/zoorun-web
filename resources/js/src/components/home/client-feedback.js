import React from 'react';
import Carousel from "react-multi-carousel";
import { ImQuotesLeft } from 'react-icons/im';

const responsive = {
    superLargeDesktop: {
        // the naming can be any, depends on you.
        breakpoint: { max: 4000, min: 3000 },
        items: 5
    },
    desktop: {
        breakpoint: { max: 3000, min: 1024 },
        items: 4
    },
    tablet: {
        breakpoint: { max: 1024, min: 464 },
        items: 2
    },
    mobile: {
        breakpoint: { max: 464, min: 0 },
        items: 1
    }
};

export const ClientFeedback = () => {
    return (
        <div className='my-20'>
            <p className='text-3xl font-bold text-center my-5' >Zoorun প্রতি গ্রাহকদের ভালোবাসা</p>
            <Carousel
                arrows={false}
                removeArrowOnDeviceType
                keyBoardControl={false}
                autoPlay={true}
                autoPlaySpeed={3000}
                infinite={true}
                responsive={responsive}>
                {[1, 2, 3, 4, 5, 6, 7, 8, 9].map((d, i) => (
                    <div key={i} className='border mx-4 p-5 rounded' >
                        <div className="flex items-center justify-between mb-5">
                            <ImQuotesLeft size={24} />
                            <p className='bg-gray-300 p-1 rounded' > Enterprises </p>
                        </div>
                        <p>দ্রুত ডেলিভারি দিয়ে এবং পার্সেলের রিটার্ন রেট কমিয়ে এনে Zoorun আমাদের অনেক সাহায্য করেছে। নেক্সট ডে পেমেন্টে সুবিধার কারণে আমাদের ক্যাশ-ফ্লো স্বাভাবিক রাখা সম্ভব হয়েছে।  </p>
                        <div className='flex items-center gap-5 mt-10' >
                            <img className='h-14 w-14 rounded-full' src="/assets/image/clientlogo.jpg" alt="" />
                            <div>
                                <p className='font-medium' >শূন্য অয়ন</p>
                                <p className='font-thin text-xs'>আলফা কনজুমার ফুড</p>
                            </div>
                        </div>
                    </div>
                ))}
            </Carousel>
        </div>
    );
};
