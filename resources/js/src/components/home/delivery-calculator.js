import React, { useEffect, useMemo, useRef, useState } from 'react';

import { InputNumber, Select, Spin } from 'antd';
import axios from 'axios';
import debounce from 'lodash/debounce';

import { Button, Checkbox, Form, Input } from 'antd';
const { Option } = Select;

function DebounceSelect({ fetchOptions, debounceTimeout = 800, ...props }) {
    const [fetching, setFetching] = useState(false);
    const [options, setOptions] = useState([]);
    const fetchRef = useRef(0);
    const debounceFetcher = useMemo(() => {
        const loadOptions = (value) => {
            fetchRef.current += 1;
            const fetchId = fetchRef.current;
            setOptions([]);
            setFetching(true);
            fetchOptions(value).then((newOptions) => {
                if (fetchId !== fetchRef.current) {
                    // for fetch callback order
                    return;
                }
                setOptions(newOptions);
                setFetching(false);
            });
        };

        return debounce(loadOptions, debounceTimeout);
    }, [fetchOptions, debounceTimeout]);
    return (
        <Select
            labelInValue
            filterOption={false}
            onSearch={debounceFetcher}
            notFoundContent={fetching ? <Spin size="small" /> : null}
            {...props}
            options={options}
        />
    );
}
export const DeliveryCalculator = () => {
    const [weight, setWeight] = React.useState([]);
    const [wight, setwight] = React.useState([]);
    const [picupArea, setPicupArea] = React.useState('');
    const [deliveryArea, setDeliveryArea] = React.useState('');
    const [price, setPrice] = React.useState('');

    const [form] = Form.useForm();


    async function fetchUserList(username) {
        return fetch('/api/web/get_locations?q=' + username)
            .then((response) => response.json())
            .then((body) => {
                // console.log(body);

                return body.map(function (item) {
                    console.log(item);
                    return {
                        label: item.name,
                        options: item.children.map(function (child) {
                            return {
                                label: child.name,
                                value: child.id,
                                id: child.id,
                                district_id: child.district_id,
                            }
                        })
                    };
                }
                );
            });
    }

    useEffect(() => {
        fetch('/api/web/get_weight_package')
            .then(response => response.json())
            .then(data => setWeight(data));
    }, []);

    const onFinish = (values) => {
        console.log(values);
        axios.post('/api/web/get_price', values)
            .then(function (response) {
                console.log(response);
                setPrice(response.data);
            })
    }




    return (
        <div className='my-20 container mx-auto flex items-center justify-center px-5 sm:px-5 md:px-0 lg:px-0'>
            <div className="mt-10 w-full sm:w-full md:w-1/2	lg:w-1/2">
                <p className='text-lg sm:text-lg md:text-3xl lg:text-3xl font-bold text-center my-5' >ডেলিভারি ক্যালকুলেটর</p>
                <p className='text-lg sm:text-lg md:text-xl lg:text-xl text-center' >ডেলিভারী চার্জ সম্পর্কে  আজই ধারণা নিন ডেলিভারি ক্যালকুলেটর থেকে</p>
                <Form
                    form={form}
                    layout="vertical"
                    name="register"
                    onFinish={onFinish}
                    initialValues={{
                        residence: ['zhejiang', 'hangzhou', 'xihu'],
                        prefix: '86',
                    }}
                    scrollToFirstError
                >
                    <div className="grid grid-cols-6 gap-6 mt-10">
                        <div className="col-span-6 sm:col-span-3">


                            <Form.Item
                                name="weight"
                                label="পণ্যের ওজন ( সর্বোচ্চ 10 কেজি )"
                                rules={[

                                    {
                                        required: true,
                                        message: 'Weight is required',
                                    },
                                ]}
                            >
                                <Select size="large" placeholder="পণ্যের ওজন নির্বাচন করুন" className="mt-1 block w-full mt-1 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                    {weight.length !== 0 && weight.map((item, index) => (
                                        <Option key={index} value={item.id}>{item.name}</Option>
                                    ))}


                                </Select>
                            </Form.Item>
                        </div>
                        <div className="col-span-6 sm:col-span-3">

                            <Form.Item
                                name="amount"
                                label="পণ্যের বিক্রয়মূল্য"
                                rules={[
                                    {
                                        required: true,
                                        message: 'Cash amount is required',
                                    },
                                ]}
                            >
                                <InputNumber size="large" className="border-gray-300 border mt-1 focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md" placeholder='পণ্যের বিক্রয়মূল্য' />
                            </Form.Item>

                        </div>
                        <div className="col-span-6 sm:col-span-3">

                            <Form.Item
                                name="pickup_area_id"
                                label="পিক-আপ এলাকা"
                                rules={[

                                    {
                                        required: true,
                                        message: 'Pickup area is required',
                                    },
                                ]}
                            >
                                <DebounceSelect
                                    mode="single"
                                    size="large"
                                    showSearch
                                    placeholder="পিক-আপ এলাকা"
                                    fetchOptions={fetchUserList}
                                    className=" border-gray-300 border mt-1 focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md"
                                    onChange={(newValue) => {
                                        // setValue(newValue);
                                        setPicupArea(newValue);
                                    }}
                                    style={{
                                        width: '100%',
                                    }}
                                />
                            </Form.Item>


                        </div>
                        <div className="col-span-6 sm:col-span-3">

                            <Form.Item
                                name="delivery_area_id"
                                label="ডেলিভারি এলাকা"
                                rules={[

                                    {
                                        required: true,
                                        message: 'Delivery area is required',
                                    },
                                ]}
                            >
                                <DebounceSelect
                                    mode="single"
                                    size="large"
                                    showSearch
                                    placeholder="ডেলিভারি এলাকা"
                                    fetchOptions={fetchUserList}
                                    className=" border-gray-300 border mt-1 focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md"
                                    onChange={(newValue) => {
                                        // setValue(newValue);
                                        setPicupArea(newValue);
                                    }}
                                    style={{
                                        width: '100%',
                                    }}
                                />
                            </Form.Item>


                        </div>

                    </div>
                    <div className="text-center">
                        <Form.Item>
                            <button type="primary" className='bg-green-500 text-white w-72 py-3 font-bold my-4 rounded mt-10' >ডেলিভারি চার্জ দেখুন</button>

                        </Form.Item>

                    </div>
                </Form>
                {/* <p className='text-center' >আপনি কি জানতে চান, যেকোনো লোকেশনে আপনার পার্সেল পাঠাতে কত খরচ হতে পারে?
                    আমাদের বিস্তারিত</p> */}
            </div>

        </div>
    );
};
