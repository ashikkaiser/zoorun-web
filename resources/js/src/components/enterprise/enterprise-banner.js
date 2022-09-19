import React, { useState } from 'react';
import bannerImage from '../../assets/image/enterprise/banner-1.jpeg'
import PhoneInput from 'react-phone-input-2'

import { AiFillCheckCircle } from 'react-icons/ai'
import Carousel from "react-multi-carousel";

const responsive = {
    superLargeDesktop: {
        breakpoint: { max: 4000, min: 3000 },
        items: 6
    },
    desktop: {
        breakpoint: { max: 3000, min: 1024 },
        items: 6
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

export const EnterpriseBanner = () => {
    const [phone, setPhone] = useState({})
    return (
        <>
            <div style={{
                backgroundImage: `url(${bannerImage})`,
                backgroundPosition: 'center',
                backgroundSize: 'cover',
                backgroundRepeat: 'no-repeat',
            }}>

                <div className="container mx-auto py-24">
                    <div className="flex justify-center items-center justify-center flex-wrap">
                        <div className='w-full sm:w-full md:w-2/5 lg:w-2/5'>
                            <div className='p-10' >
                                <p className='text-white  my-4 text-4xl font-bold leading-tight ' >দেশ সেরা এন্টারপ্রাইজ লজিস্টিকস পৌঁছাবে আপনার লক্ষ্যে</p>
                                <div className="flex items-center gap-5 mb-3">
                                    <AiFillCheckCircle color='green' size={24} />
                                    <p className='text-white text-xl' >দেশব্যাপী লজিস্টিক্স নেটওয়ার্ক</p>
                                </div>
                                <div className="flex items-center gap-5 mb-3">
                                    <AiFillCheckCircle color='green' size={24} />
                                    <p className='text-white text-xl' >মাত্র ৩ ঘণ্টায় বাণিজ্যিক ট্রাক</p>
                                </div>
                                <div className="flex items-center gap-5 mb-3">
                                    <AiFillCheckCircle color='green' size={24} />
                                    <p className='text-white text-xl' >সুরক্ষিত পরিবহনের নিশ্চয়তা</p>
                                </div>
                                <p>
                                    <span className='text-white text-xl'>সরাসরি আমাদের সেলস টিম কে কল করুনঃ</span>
                                    <a href="tel:+1234567890"><span className='text-green-600 text-xl'> +1234567890</span></a>

                                </p>
                            </div>

                        </div>
                        <div className='rounded w-full sm:w-full md:w-2/5 lg:w-2/5 ' style={{ backgroundColor: "#000" }}  >
                            <div className='p-10' >
                                <p className='text-white text-center my-4' >বিনামুল্যে সাইন-আপ করুন মাত্র দুই মিনিটে</p>
                                <div className='my-4'>
                                    <PhoneInput
                                        placeholder={'Phone Number'}
                                        enableAreaCodes={true}
                                        containerStyle={{
                                            height: 45
                                        }}
                                        inputStyle={{
                                            height: 45,
                                            paddingLeft: 65,
                                            fontSize: 16,
                                            width: "100%"
                                        }}
                                        buttonStyle={{
                                            backgroundColor: 'transparent',
                                            paddingLeft: 10,
                                            paddingTop: 10,
                                            paddingBottom: 10,
                                        }}
                                        disableCountryCode={false}
                                        countryCodeEditable={false}
                                        disableDropdown={true}
                                        onlyCountries={['bd', 'bd']}
                                        country={'bd'}
                                        onChange={phone => setPhone({ phone: phone })}
                                    />
                                </div>
                                <button className='bg-green-500 text-white w-full py-3 font-bold my-4 rounded' >সাইন-আপ </button>
                                <div className='flex items-center gap-5 my-5' >
                                    <div style={{ border: '.05px solid white', width: 400, height: 0 }} ></div>
                                    <p className='text-white' >অথবা,</p>
                                    <div style={{ border: '.05px solid white', width: 400, height: 0 }} ></div>
                                </div>
                                <input className='w-full my-5 p-3 rounded border-green-500' placeholder='ট্র্যাকিং আইডি দিন ' type="text" />
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <div className='my-10 container mx-auto' >
                <Carousel
                    arrows={false}
                    removeArrowOnDeviceType
                    keyBoardControl={false}
                    autoPlay={true}
                    autoPlaySpeed={3000}
                    infinite={true}
                    responsive={responsive}>
                    <img className='w-20' src="/assets/image/merchant/BD Beponi.png" alt="merchent Image" />
                    <img className='w-20' src="/assets/image/merchant/Priyoshop Logo.png" alt="merchent Image" />
                    <img className='w-20' src="/assets/image/merchant/Q Comm.png" alt="merchent Image" />
                    <img className='w-20' src="/assets/image/merchant/BD Beponi.png" alt="merchent Image" />
                    <img className='w-20' src="/assets/image/merchant/Priyoshop Logo.png" alt="merchent Image" />
                    <img className='w-20' src="/assets/image/merchant/Q Comm.png" alt="merchent Image" />
                </Carousel>
            </div>
        </>
    );
};
