import React from 'react';

export const ContactUs = () => {
    return (
        <div className='container mx-auto flex justify-center' >
            <div className='grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-6 w-full sm:w-full md:w-3/4 lg:w-3/4 px-5 sm:px-5 md:px-0 lg:px-0'>
                <div className='col-span-2 mt-20'>
                    <p className='text-4xl font-bold text-center'>আমাদের সাথে যোগাযোগ করুন</p>
                    <form action="">
                        <div className='grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-10'>
                            <div className='mb-3 col-span-2 sm:col-span-2 md:col-span-1 lg:col-span-1'>
                                <label for="name" className="block text-sm font-medium text-gray-700">নাম</label>
                                <input type="text" name="name" id="first-name" autocomplete="given-name" className=" border-gray-300 border p-3 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md" placeholder='আপনার নাম লিখুন ' required />
                            </div>
                            <div className='mb-3 col-span-2 sm:col-span-2 md:col-span-1 lg:col-span-1'>
                                <label for="name" className="block text-sm font-medium text-gray-700">ই-মেইল</label>
                                <input type="text" name="name" id="first-name" autocomplete="given-name" className=" border-gray-300 border p-3 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md" placeholder='আপনার ই-মেইল লিখুন ' required />
                            </div>
                            <div className='mb-3 col-span-2 sm:col-span-2 md:col-span-1 lg:col-span-1'>
                                <label for="name" className="block text-sm font-medium text-gray-700">ফোন নাম্বার</label>
                                <input type="text" name="name" id="first-name" autocomplete="given-name" className=" border-gray-300 border p-3 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md" placeholder='আপনার ফোন নাম্বার দিন' required />
                            </div>
                            <div className='mb-3 col-span-2 sm:col-span-2 md:col-span-1 lg:col-span-1'>
                                <label for="name" className="block text-sm font-medium text-gray-700">কোম্পানির নাম</label>
                                <input type="text" name="name" id="first-name" autocomplete="given-name" className=" border-gray-300 border p-3 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md" placeholder='আপনার কোম্পানির নাম লিখুন' required />
                            </div>
                            <div className='col-span-2'>
                                <label for="name" className="block text-sm font-medium text-gray-700">আপনার প্রয়োজন সম্পর্কে আমাদের জানান</label>
                                <textarea type="text" name="name" id="first-name" autocomplete="given-name" className=" border-gray-300 border p-3 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md" placeholder='বিস্তারিত লিখুন' required />
                            </div>
                            <div className='mb-3 col-span-2 sm:col-span-2 md:col-span-1 lg:col-span-1'>
                                <button type='submit' className='bg-green-500 text-white w-full py-3 font-bold my-4 rounded' >সাবমিট</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div >
                    <img src="/assets/image/enterprise/contact-us-image2.webp" alt="" />
                </div>
            </div>


        </div>
    );
};
