import React from 'react';

export const BranchLocation = () => {
    return (
        <div className="bg-black  ">
            <div className='max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-10 md:py-20 '>
                <p className='text-white text-4xl font-bold text-center'>রেডেক্স কুরিয়ার হোম এবং অফিস ডেলিভারি সেবা দিচ্ছে বাংলাদেশের ৬৪ জেলায়</p>
                <p className='text-white text-xl text-center mt-8' >নিচের যেকোনো লোকেশন থেকে কুরিয়ার বুক করুন, আমরা পৌছে দিবো কম সময়ে বাংলাদেশের যেকোনো প্রান্তে</p>
                <div className="mt-8">
                    <div className=" flex rounded-md border-r-0">
                        <input type="text" name="company-website" id="company-website" className="border focus:ring-green-500 focus:border-green-500 focus:border flex-1 block w-full   rounded-l sm:text-sm border-gray-300 px-5 " placeholder="Search" />
                        <span className="inline-flex items-center px-10 py-2 rounded-r-md border-l-0 border-gray-300 bg-green-600   text-lg text-white"> Search</span>
                    </div>
                </div>
                <div className='bg-white mt-5 rounded '>
                    <div style={{ height: 500 }} className="flex flex-col overflow-y-auto overflow-x-hidden">
                        <div className="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div className="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div className="">
                                    <table className="min-w-full">
                                        <thead className="border-b">
                                            <tr>
                                                <th scope="col" className="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Sl
                                                </th>
                                                <th scope="col" className="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Branch Name
                                                </th>
                                                <th scope="col" className="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Address
                                                </th>
                                                <th scope="col" className="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                    Contact
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {[1, 2, 3, 4, 5, 6, 7, 8, 9].map((d, i) => (
                                                <tr key={i} className="border-b">
                                                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{i + 1}</td>
                                                    <td className="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        Agrabad
                                                    </td>
                                                    <td className="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        Holding no 2366 bepari para agrabad acces Road bandar
                                                    </td>
                                                    <td className="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                        +8801958520000
                                                    </td>
                                                </tr>
                                            ))}


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    );
};
