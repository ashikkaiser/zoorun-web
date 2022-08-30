import React, { useState } from 'react';
import Carousel from "react-multi-carousel";
import ReactPlayer from 'react-player'
import PhoneInput from 'react-phone-input-2'

const responsive = {
    superLargeDesktop: {
        // the naming can be any, depends on you.
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

export const Banner = () => {
    const [phone, setPhone] = useState({})

    return (
        <div style={{ position: "relative" }} >
            <Carousel
                arrows={false}
                removeArrowOnDeviceType
                keyBoardControl={false}
                autoPlay={true}
                autoPlaySpeed={6000}
                infinite={true}
                responsive={responsive}>
                <div className=' h-full sm:h-full  md:h-3/5 lg:h-3/5' >
                    {/* <img src={require('../../assets/image/home/banner/homeBanner.jpg')} alt="" /> */}
                    <ReactPlayer width={"100%"} muted={true} playing={true} height={'100%'} url="https://d118vismjsp9sl.cloudfront.net/web2.0/video/hero-video-1.webm" />
                </div>
                <div className=' h-full sm:h-full  md:h-3/5 lg:h-3/5' >
                    <ReactPlayer width={'100%'} muted={true} playing={true} height={'100%'} url="https://d118vismjsp9sl.cloudfront.net/web2.0/video/hero-video-2.webm" />
                </div>
                <div className=' h-full sm:h-full  md:h-3/5 lg:h-3/5' >
                    <ReactPlayer width={'100%'} muted={true} playing={true} height={'100%'} url="https://d118vismjsp9sl.cloudfront.net/web2.0/video/hero-video-3.webm" />
                </div>
                <div className=' h-full sm:h-full  md:h-3/5 lg:h-3/5' >
                    <ReactPlayer width={'100%'} muted={true} playing={true} height={'100%'} url="https://d118vismjsp9sl.cloudfront.net/web2.0/video/hero-video-4.webm" />
                </div>
            </Carousel>

            <div
                className=' w-full sm:w-full  md:w-1/3	 lg:w-1/3  h-full sm:h-full  md:h-3/5 lg:h-3/5 md:absolute lg:absolute top-0 right-0 bg-black '
                style={{
                    borderBottomLeftRadius: 20
                }}
            >
                <div className="w-full sm:w-full  md:w-3/4 lg:w-3/4   mx-auto px-4 sm:px-4 md:px-0 lg:px-0 py-10 sm:py-10 md:py-24 lg:py-24">
                    <div className="">
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
                        <div className=" flex rounded-md border-r-0">
                            <input type="text" name="company-website" id="company-website" className="border focus:ring-green-500 focus:border-green-500 focus:border flex-1 block w-full   rounded-l sm:text-sm border-gray-300 px-5 " placeholder="পার্সেল আইডি" />
                            <span className="inline-flex items-center px-10 py-2 rounded-r-md border-l-0 border-gray-300 bg-green-600  text-lg text-white"> ট্র্যাক</span>
                        </div>
                    </div>
                </div>

            </div>


            <div className='container mx-auto mt-10 px-5'>
                <div className='grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6'>
                    <div className='flex items-center' >
                        <p className='text-gray-400' >TOP ENTERPRISES</p>
                        <img className='w-20 sm:w-20 md:w-40 lg:w-40 grayscale hover:grayscale-0' src="/assets/image/bata-color.png" alt="" />
                        <img className='w-20 sm:w-20 md:w-40 lg:w-40 grayscale hover:grayscale-0' src="/assets/image/rangs-group-color.png" alt="" />
                        <img className='w-20 sm:w-20 md:w-40 lg:w-40 grayscale hover:grayscale-0' src="/assets/image/lotto-color.png" alt="" />
                    </div>
                    <div className='flex items-center gap-14' >
                        <p className='text-gray-400' >TOP SMES</p>
                        <img className='w-10 sm:w-10 md:w-24 grayscale hover:grayscale-0' src="/assets/image/daraz-color.png" alt="" />
                        <img className='w-10 sm:w-10 md:w-24 grayscale hover:grayscale-0' src="/assets/image/ajkerdeal-color.png" alt="" />
                        <img className='w-10 sm:w-10 md:w-24 grayscale hover:grayscale-0' src="/assets/image//othoba-color.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    );
};
