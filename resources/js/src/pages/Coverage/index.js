import React, { useEffect } from 'react';
import { BranchLocation, CourierBanner, CourierSupport, EnjoyDeliveryCharge, Faq, Login } from '../../components';
import { } from '../../components/enterprise';
import { Select, Layout, Table, Space } from 'antd';
const { Option } = Select;
const { Header, Content, Footer } = Layout;

export const Coverage = () => {

    const [loading, setLoading] = React.useState(false);
    const onChange = (value) => {
        console.log(`selected ${value}`);
        randerAreas(value);
    };

    const onSearch = (value) => {
        console.log('search:', value);
    };



    const columns = [
        {
            title: 'District',
            dataIndex: 'district',
            key: 'district',
            render: text => text?.name,

        },
        {
            title: 'Area',
            dataIndex: 'name',
            key: 'name',
        },
        {
            title: 'Post Code',
            dataIndex: 'postal_code',
            key: 'postal_code',
        },
        {
            title: 'COD Charge',
            dataIndex: 'address',
            key: 'address',
        },
    ];

    const [serviceAreas, setServiceAreas] = React.useState([]);
    const [areas, setAreas] = React.useState([]);
    useEffect(() => {
        setLoading(true);
        fetch('/api/web/service_areas')
            .then(response => response.json())
            .then(data => {
                setLoading(false);
                setServiceAreas(data)
            });


    }, []);

    const randerAreas = (data) => {
        setLoading(true);
        fetch('/api/web/geta_areas?service_area_id=' + data)
            .then(response => response.json())
            .then(data => {
                setAreas(data)
                setLoading(false);
            });
    }



    return (
        <>
            <div className='container mx-auto py-10 max-w-7xl'>
                <Space direction="horizontal" size={12} className="mb-3">
                    <h1>Area Selection</h1>
                    <Select
                        showSearch
                        placeholder="Choose Area"
                        optionFilterProp="children"
                        onChange={onChange}
                        onSearch={onSearch}
                        filterOption={(input, option) => option.children.toLowerCase().includes(input.toLowerCase())}
                    >
                        {serviceAreas.map((serviceArea) => (
                            <Option value={serviceArea.id}>{serviceArea.name}</Option>
                        ))}

                    </Select>
                </Space>



                <Table
                    size='small'
                    ellipsis={true}
                    fixedHeader={true}
                    bordered={true}
                    loading={loading}
                    pagination={{
                        pageSize: 20,
                        showSizeChanger: false,
                    }}
                    dataSource={areas} columns={columns} />


            </div>
        </>

    );
};
