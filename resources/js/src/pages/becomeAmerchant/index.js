import React, { useEffect, useState } from 'react';
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
        items: 3
    },
    mobile: {
        breakpoint: { max: 464, min: 0 },
        items: 3
    }
};
import { Button, Checkbox, Form, Input, Space, Select, notification } from 'antd';
const { Option } = Select;

export const becomeAmerchant = () => {
    const [phone, setPhone] = useState({})

    const [form] = Form.useForm();
    const [districts, setDistricts] = useState([]);
    const [areas, setAreas] = useState([]);
    const [success, setSuccess] = useState(false);
    const [error, setError] = useState(false);

    useEffect(() => {
        fetch('/api/web/get_districts')
            .then(response => response.json())
            .then(data => setDistricts(data));
    }, []);
    const districtValue = Form.useWatch('district', form);
    useEffect(() => {
        fetch('/api/web/get_area?district_id=' + districtValue)
            .then(response => response.json())
            .then(data => setAreas(data));
    }, [districtValue]);



    const onFinish = (values) => {

        fetch('/api/web/become_a_merchant', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(values)
        })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    setSuccess(true);
                    setError(false);
                    notification['success']({
                        message: 'Success',
                        description: data.message,
                    });
                } else {
                    setSuccess(false);

                    notification['error']({
                        message: 'Error',
                        description: data.message,
                    });
                }
                // if (data.status == 200) {
                //     setSuccess(true);
                // } else {
                //     setError(data);
                //     console.log(data)
                // }
            });
    };




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
                                <p className='text-white  my-4 text-4xl font-bold leading-tight ' >????????? ???????????? ???????????? ?????????????????? ??????????????????????????? ?????????????????? ????????? ??????????????? ???????????? ??????????????????????????? ????????????????????? ????????????????????? ????????????</p>
                                <div className="flex items-center gap-5 mb-3">
                                    <AiFillCheckCircle color='green' size={24} />
                                    <p className='text-white text-xl' >?????? ?????????????????? ????????????????????? ????????????????????????</p>
                                </div>
                                <div className="flex items-center gap-5 mb-3">
                                    <AiFillCheckCircle color='green' size={24} />
                                    <p className='text-white text-xl' >COD ????????????????????? ????????? ????????????????????? ?????????</p>
                                </div>
                                <div className="flex items-center gap-5 mb-3">
                                    <AiFillCheckCircle color='green' size={24} />
                                    <p className='text-white text-xl' >???????????????????????? ???????????? ???????????????????????? ????????????????????????</p>
                                </div>
                                <p>
                                    <span className='text-white text-xl'>??????????????? ???????????????????????? ?????????????????? ?????????????????? ????????? ?????? ?????? ??????????????? </span>
                                    <a href="tel:+8801324411649"><span className='text-green-600 text-xl'> +8801324411649</span></a>

                                </p>
                            </div>

                        </div>
                        <div className='rounded w-full sm:w-full md:w-2/5 lg:w-2/5 bg-white'  >
                            <div className='p-10' >
                                <p className='text-black text-center my-4' >?????????????????????????????? ????????????-?????? ???????????? ??????????????? ????????? ??????????????????</p>
                                <div className='my-4'>
                                    {success ? (
                                        <div className='flex justify-center'>
                                            <div class="w-full max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">

                                                <div class="flex flex-col items-center pb-10 px-2">
                                                    <img class="mb-3 w-24 h-24 rounded-full " src="/assets/image/check.png" alt="Bonnie image" />
                                                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
                                                        ????????????????????? ????????????-?????? ???????????????
                                                    </h5>
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                                        ??????????????? ????????????-?????? ????????? ?????????????????? ??????????????? ????????????-?????? ?????? ???????????? ????????????????????????
                                                        ?????????????????????????????? ??????????????? ?????????????????? ????????????????????? ????????? ??????????????? ???????????? ????????????????????? ????????????

                                                    </span>
                                                    <div class="flex mt-4 space-x-3 md:mt-6">
                                                        <a href="#" class="inline-flex items-center py-2 px-4 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">???????????????</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ) : (
                                        <Form
                                            form={form}
                                            name="basic"
                                            initialValues={{ remember: true }}
                                            onFinish={onFinish}
                                            layout='vertical'
                                            style={{ width: '100%' }}
                                            autoComplete="off"
                                        >

                                            <Form.Item
                                                style={{ width: '100%' }}
                                                label={'??????????????? ?????????'}
                                                name="name"
                                                rules={[{ required: true, message: '??????????????? ????????? ???????????????' }]}
                                            >
                                                <Input className=' border-gray-300 border p-2 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md' />
                                            </Form.Item>

                                            <Form.Item
                                                label={"??????????????? ??????????????????????????? ?????????"}
                                                name="company"

                                                rules={[{ required: true, message: '??????????????? ??????????????????????????? ????????? ???????????????' }]}
                                            >
                                                <Input className='border-gray-300 border p-2 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md' />
                                            </Form.Item>
                                            <Form.Item
                                                label={"??????????????? ?????????????????? ?????????????????????"}
                                                name="phone"

                                                rules={[{ required: true, message: '??????????????? ?????????????????? ????????????????????? ???????????????' }]}
                                            >
                                                <Input className='border-gray-300 border p-2 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md' />
                                            </Form.Item>
                                            <Form.Item
                                                label={"??????????????? ???????????????"}
                                                name="email"

                                                rules={[{ required: true, message: '??????????????? ??????????????? ???????????????' }]}
                                            >
                                                <Input className='border-gray-300 border p-2 mt-1   focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md' />
                                            </Form.Item>

                                            <div className='flex justify-between gap-2' >
                                                <Form.Item
                                                    label={"??????????????? ????????????"}
                                                    className='w-1/2'
                                                    name="district"
                                                    rules={[{
                                                        required: true, message: '??????????????? ???????????? ???????????????????????? ????????????'
                                                    }]}
                                                >
                                                    <Select
                                                        showSearch
                                                        placeholder={'??????????????? ???????????? ???????????????????????? ???????????? '}
                                                        optionFilterProp="children"
                                                        className='border-gray-300 border mt-1 focus:border-green-500 block w-full shadow-sm sm:text-sm focus:border rounded-md'
                                                        filterOption={(input, option) => option.children.toLowerCase().includes(input.toLowerCase())}
                                                    >
                                                        {districts.map((district, index) => (
                                                            <Option key={index} value={district.id}>{district.name}</Option>
                                                        ))}

                                                    </Select>
                                                </Form.Item>
                                                <Form.Item
                                                    label={"??????????????? ???????????????"}
                                                    name="area"
                                                    className='w-1/2'
                                                    rules={[{ required: true, message: '??????????????? ??????????????? ???????????????????????? ????????????' }]}
                                                >
                                                    <Select
                                                        className='border-gray-300 border mt-1 focus:border-green-500 block w-full sm:text-sm focus:border rounded-md'
                                                        showSearch
                                                        placeholder={'??????????????? ??????????????? ???????????????????????? ???????????? '}
                                                        optionFilterProp="children"
                                                        filterOption={(input, option) => option.children.toLowerCase().includes(input.toLowerCase())}
                                                    >
                                                        {areas.map((area, index) => (
                                                            <Option key={index} value={area.id}>{area.name}</Option>
                                                        ))}

                                                    </Select>
                                                </Form.Item>
                                            </div>

                                            <Form.Item
                                                label={"??????????????? ???????????????????????????"}
                                                name="password"
                                                rules={[{ required: true, message: '??????????????? ??????????????????????????? ???????????????' }]}
                                            >
                                                <Input.Password
                                                    className='border-gray-300 border rounded-md'
                                                />
                                            </Form.Item>

                                            <Form.Item
                                                label={"??????????????? ??????????????????????????? ????????????????????? ????????????"}
                                                name="confirm"

                                                rules={[{ required: true, message: '??????????????? ??????????????????????????? ????????????????????? ????????????' }]}
                                            >
                                                <Input.Password className='border-gray-300 border rounded-md' />
                                            </Form.Item>
                                            <Form.Item>
                                                <Button
                                                    size='large' type="primary" htmlType="submit" className='bg-green-500 text-white w-full font-bold my-4 rounded border-none'>
                                                    ????????????-??????
                                                </Button>
                                            </Form.Item>
                                        </Form>

                                    )}












                                    {/* <PhoneInput
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
                                    /> */}
                                </div>


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
