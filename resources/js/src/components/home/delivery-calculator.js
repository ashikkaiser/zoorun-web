import React, { useEffect } from 'react';

export const DeliveryCalculator = () => {
    const [weight, setWeight] = React.useState([]);

    useEffect(() => {
        fetch('/api/web/get_weight_package')
            .then(response => response.json())
            .then(data => setWeight(data));
    }, []);

    const searchLocation = (e) => {

    }




    return (
        <div className='my-20 container mx-auto flex items-center justify-center px-5 sm:px-5 md:px-0 lg:px-0'>
            <div className="mt-10 w-full sm:w-full md:w-1/2	lg:w-1/2">
                <p className='text-lg sm:text-lg md:text-3xl lg:text-3xl font-bold text-center my-5' >ডেলিভারি ক্যালকুলেটর</p>
                <p className='text-lg sm:text-lg md:text-xl lg:text-xl text-center' >ডেলিভারী চার্জ সম্পর্কে  আজই ধারণা নিন ডেলিভারি ক্যালকুলেটর থেকে</p>
                <div className="grid grid-cols-6 gap-6 mt-10">
                    <div className="col-span-6 sm:col-span-3">
                        <label for="wight" className="block text-sm font-medium text-gray-700">পণ্যের ওজন ( সর্বোচ্চ 10 কেজি )</label>
                        <select id="wight" name="wight" autocomplete="wight" className="mt-1 block w-full p-3 mt-1 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option>ওজন নির্বাচন করুন</option>
                            {weight.length !== 0 && weight.map((item, index) => (
                                <option key={index} value={item.id}>{item.name}</option>

                            ))}
                        </select>
                        {/* <input type="text" name="wight" id="first-name" autocomplete="given-name" className=" border-gray-300 border p-3 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md" placeholder='পণ্যের ওজন লিখুন ' /> */}
                    </div>
                    <div className="col-span-6 sm:col-span-3">
                        <label for="wight" className="block text-sm font-medium text-gray-700">পণ্যের বিক্রয়মূল্য</label>
                        <input type="text" name="wight" id="first-name" autocomplete="given-name" className=" border-gray-300 border p-3 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md" placeholder='পণ্যের বিক্রয়মূল্য' />
                    </div>
                    <div className="col-span-6 sm:col-span-3">
                        <label for="wight" className="block text-sm font-medium text-gray-700">পিক-আপ এলাকা</label>
                        <input type="text" name="wight" id="first-name" autocomplete="given-name" className=" border-gray-300 border p-3 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md" placeholder='পিক-আপ এলাকা' />
                    </div>
                    <div className="col-span-6 sm:col-span-3">
                        <label for="wight" className="block text-sm font-medium text-gray-700">ডেলিভারি এলাকা</label>
                        <input type="text" name="wight" id="first-name" autocomplete="given-name" className=" border-gray-300 border p-3 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md" placeholder='ডেলিভারি এলাকা' />
                    </div>
                </div>
                <div className="text-center">
                    <button className='bg-green-500 text-white w-72 py-3 font-bold my-4 rounded mt-10' >ডেলিভারি চার্জ দেখুন</button>
                </div>
                {/* <p className='text-center' >আপনি কি জানতে চান, যেকোনো লোকেশনে আপনার পার্সেল পাঠাতে কত খরচ হতে পারে?
                    আমাদের বিস্তারিত</p> */}
            </div>

        </div>
    );
};
