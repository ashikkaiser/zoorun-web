import React from 'react';
import { Fragment } from 'react'
import { Popover, Transition } from '@headlessui/react'
import { MenuIcon, XIcon, } from '@heroicons/react/outline'
import { Link } from "react-router-dom";




export const Header = () => {



    return (
        <Popover className="relative bg-white border-b-2 border-gray-100">
            <div className="max-w-7xl mx-auto px-4 sm:px-6">
                <div className="flex justify-between items-center  py-2 md:justify-start md:space-x-10">
                    <div className="flex justify-start">
                        <Link to="/">

                            <span className="sr-only">Workflow</span>
                            <img
                                className="h-8 w-auto sm:h-10"
                                src="/assets/image/logo.png"
                                alt=""
                            />
                        </Link>

                    </div>
                    <div className="-mr-2 -my-2 md:hidden">
                        <Popover.Button className="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                            <span className="sr-only">Open menu</span>
                            <MenuIcon className="h-6 w-6" aria-hidden="true" />
                        </Popover.Button>
                    </div>
                    {/* <Popover.Group as="nav" className="hidden md:flex space-x-10 ">

                        <Link className="text-base font-medium text-gray-500 hover:text-gray-900" to="/enterprise">Enterprise</Link>
                        <Link className="text-base font-medium text-gray-500 hover:text-gray-900" to="/courier">
                            Courier
                        </Link>



                    </Popover.Group> */}
                    <div className="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                        <Link to="/become-a-merchant" className="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                            Become a merchant
                        </Link>

                        {/* <a
                            className="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
                            type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        >
                            Track Your Order
                        </a> */}

                        <Link to='/signin'
                        // className="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"

                        >
                            <button type="button" class="ml-8 text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 text-center mr-2  dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Sign in</button>


                        </Link>

                    </div>
                </div>
            </div>




            <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg relative w-auto pointer-events-none">
                    <div
                        class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div
                            class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                            <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">Track Your Order</h5>
                            <button type="button"
                                class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body relative p-4">
                            <div className=" ">
                                <div className=" flex rounded-md border-r-0">
                                    <input type="text" name="company-website" id="company-website" className="border focus:ring-green-500 focus:border-green-500 focus:border flex-1 block w-full   rounded-l sm:text-sm border-gray-300 px-5 " placeholder="পার্সেল আইডি" />
                                    <span className="inline-flex items-center px-10 py-2 rounded-r-md border-l-0 border-gray-300 bg-green-600  text-lg text-white"> Track</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                            <button type="button" class="px-6
          py-2.5
          bg-red-600
          text-white
          font-medium
          text-xs
          leading-tight
          uppercase
          rounded
          shadow-md
          hover:bg-purple-700 hover:shadow-lg
          focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0
          active:bg-purple-800 active:shadow-lg
          transition
          duration-150
          ease-in-out" data-bs-dismiss="modal">Cancel</button>

                        </div>
                    </div>
                </div>
            </div>





            <Transition
                as={Fragment}
                enter="duration-200 ease-out"
                enterFrom="opacity-0 scale-95"
                enterTo="opacity-100 scale-100"
                leave="duration-100 ease-in"
                leaveFrom="opacity-100 scale-100"
                leaveTo="opacity-0 scale-95"
            >
                <Popover.Panel focus className="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
                    <div className="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
                        <div className="pt-5 pb-6 px-5">
                            <div className="flex items-center justify-between">
                                <div>
                                    <img
                                        className="h-8 w-auto"
                                        src="/assets/image/logo.png"
                                        alt="Workflow"
                                    />
                                </div>
                                <div className="-mr-2">
                                    <Popover.Button className="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                        <span className="sr-only">Close menu</span>
                                        <XIcon className="h-6 w-6" aria-hidden="true" />
                                    </Popover.Button>
                                </div>
                            </div>
                            <div className="mt-6">
                                <nav className="grid gap-y-8">
                                </nav>
                            </div>
                        </div>
                        <div className="py-6 px-5 space-y-6">
                            <div className="grid grid-cols-2 gap-y-4 gap-x-8">
                                <Link className="text-base font-medium text-gray-900 hover:text-gray-700" to="/enterprise">Enterprise</Link>
                                {/* <a href="#" className="text-base font-medium text-gray-900 hover:text-gray-700">
                                    Enterprise
                                </a> */}
                                <Link className="text-base font-medium text-gray-900 hover:text-gray-700" to="/courier">
                                    Courier
                                </Link>

                                {/* {resources.map((item) => (
                                    <a
                                        key={item.name}
                                        href={item.href}
                                        className="text-base font-medium text-gray-900 hover:text-gray-700"
                                    >
                                        {item.name}
                                    </a> */}
                                {/* ))} */}
                            </div>
                            <div>
                                <a
                                    href="#"
                                    className="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                                >
                                    Track Your Order
                                </a>
                                <p className="mt-6 text-center text-base font-medium text-gray-500">
                                    Existing customer?{' '}
                                    <Link to={"/signin"} className="text-indigo-600 hover:text-indigo-500">
                                        Sign in
                                    </Link>
                                </p>
                            </div>
                        </div>
                    </div>
                </Popover.Panel>
            </Transition>
        </Popover>

    )
};
