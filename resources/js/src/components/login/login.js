import React, { useState } from 'react';
import { IoIosArrowForward } from 'react-icons/io';
import PhoneInput from 'react-phone-input-2'
import Carousel from "react-multi-carousel";

const responsive = {
    superLargeDesktop: {
        breakpoint: { max: 4000, min: 3000 },
        items: 1
    },
    desktop: {
        breakpoint: { max: 3000, min: 1024 },
        items: 1
    },
    tablet: {
        breakpoint: { max: 1024, min: 464 },
        items: 1
    },
    mobile: {
        breakpoint: { max: 464, min: 0 },
        items: 1
    }
};

export const LoginItem = () => {
    const [phone, setPhone] = useState({})
    return (
        <div className="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
            <div className='  max-w-7xl mx-auto px-4 sm:px-6 md:px-24 lg:px-24 bg-white min-h-screen flex items-center' >
                <div className="flex justify-center">
                    <div className=' w-full sm:w-full md:w-2/3 lg:w-2/3'>
                        <p className='text-3xl font-bold' >Welcome!</p>
                        <p className='text-md '>Enter your phone number to login or create new account and hit “Continue” to get an OTP.</p>
                        <div className='mt-5'>
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
                        <button className='bg-green-500 text-white py-3 font-bold my-4 rounded px-5 w-full ' ><span>Continue</span> </button>
                        <p>By logging in you agree to our <span className='font-bold text-green-600' >Privacy policy</span></p>
                        <div className='border-b border-gray my-5' />
                        <p>For partner account <span className='font-bold text-green-600'>Login with password</span></p>
                    </div>
                </div>
            </div>
            <div className='bg-gray-100 min-h-screen  max-w-7xl px-auto px-4 sm:px-6 md:px-24 lg:px-24 flex items-center justify-center' >
                <div className="w-2/3">
                    <Carousel
                        dotListClass={'login-dot-style'}
                        itemClass={'carousel-item-padding-40-px'}
                        showDots={true}
                        arrows={false}
                        keyBoardControl={false}
                        autoPlay={true}
                        autoPlaySpeed={2000}
                        infinite={true}
                        responsive={responsive}>
                        <div className='flex justify-center items-center flex-col	'  >
                            <div className=''  >
                                <img className='w-96 text-center shadow-lg' src="/assets/image/login/parcel-tracking.png" alt="" />
                            </div>
                            <div className='mt-14'  >
                                <p className='text-center text-2xl font-bold'>Track your parcels </p>
                                <p className='text-center text-gray-500 mt-3'>Get detailed breakdown of your payment invoice and download your receipt for your business</p>
                            </div>
                        </div>
                        <div className='flex justify-center items-center flex-col	'  >
                            <div className=''  >
                                <img className='w-96 text-center shadow-lg' src="/assets/image/login/payment.png" alt="" />
                            </div>
                            <div className='mt-14'  >
                                <p className='text-center text-2xl font-bold'>Get payment details</p>
                                <p className='text-center text-gray-500 mt-3'>Get detailed breakdown of your payment invoice and download your receipt for your business</p>
                            </div>
                        </div>
                        <div className='flex justify-center items-center flex-col	'  >
                            <div className=''  >
                                <img className='w-96 text-center shadow-lg' src="/assets/image/login/issue-raise.png" alt="" />
                            </div>
                            <div className='mt-14'  >
                                <p className='text-center text-2xl font-bold'>Raise an issue</p>
                                <p className='text-center text-gray-500 mt-3'>Having trouble? Raise an issue directly from parcel panel for specific parcel and select the type of issue it is facing</p>
                            </div>
                        </div>
                    </Carousel>
                </div>
            </div>
        </div>
    );
};
