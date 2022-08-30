import React, { useState } from 'react';
const data = [
    {
        id: 1,
        size: "৯ ফিট খোলা পিকআপ",
        ability: "১"
    },
    {
        id: 2,
        size: "১২ ফিট খোলাট্রাক",
        ability: "২"
    },
    {
        id: 3,
        size: "১৪ ফিট খোলাট্রাক",
        ability: "৩.৫"
    },
    {
        id: 4,
        size: "১৬ ফিট খোলাট্রাক",
        ability: "৭.৫"
    },
    {
        id: 5,
        size: "১৮ ফিট খোলাট্রাক",
        ability: "১৫"
    },
    {
        id: 6,
        size: "২৩ ফিট খোলাট্রাক",
        ability: "২৫"
    }
]
const data2 = [
    {
        id: 1,
        size: "৯ ফিট কাভার্ড ভ্যান",
        ability: "১"
    },
    {
        id: 2,
        size: "১২ ফিট কাভার্ড ভ্যান",
        ability: "২"
    },
    {
        id: 3,
        size: "১৪ ফিট কাভার্ড ভ্যান",
        ability: "৩.৫"
    },
    {
        id: 4,
        size: "১৬ ফিট কাভার্ড ভ্যান",
        ability: "৭.৫"
    },
    {
        id: 5,
        size: "১৮ ফিট কাভার্ড ভ্যান",
        ability: "১৫"
    },
    {
        id: 6,
        size: "২৩ ফিট কাভার্ড ভ্যান",
        ability: "২৫"
    }
]

export const Vehicles = () => {
    const [truckData, setTruckData] = useState(data)
    const [activebtn, setActiveBtn] = useState('open')


    const handletab = (e) => {
        if (e === 'open') {
            setTruckData(data)
            setActiveBtn(e)
        }
        else {
            setTruckData(data2)
            setActiveBtn(e)
        }
    }
    const active = {
        borderBottomColor: "green",
        borderBottomWidth: 3,
        padding: 5, fontWeight: "600"
    }
    const inActive = {
        color: "green",
        padding: 5, fontWeight: "600"
    }

    return (
        <div className='container mx-auto' >
            <p className='text-3xl font-bold text-center ' >আপনার লক্ষ্যে পৌঁছাতে আমাদের রয়েছে বিভিন্ন সাইজের ট্রান্সপোর্ট ভেহিকেল</p>
            <div className='flex gap-10 items-center justify-center mt-10' >
                <button style={activebtn === 'open' ? active : inActive} onClick={() => handletab('open')}>Open </button>
                <button style={activebtn === 'cover' ? active : inActive} onClick={() => handletab('cover')}>Covered </button>
            </div>
            <div className='flex items-center justify-center gap-10 flex-wrap my-10' >
                {truckData.map((d, i) => (
                    <div className="border p-5 rounded">
                        <div className='flex items-center justify-center'>
                            <img src="/assets/image/enterprise/9-feet-covered-van.png" alt="" />
                        </div>
                        <p className='text-center font-bold text-sm my-2' >{d.size}</p>
                        <p className='text-center font-thin text-sm'>{d.ability} টন ধারনক্ষমতা সম্পন্ন</p>
                    </div>
                ))}
            </div>
        </div>
    );
};
