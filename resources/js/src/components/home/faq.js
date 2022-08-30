import React, { useState } from 'react';
import { BsPlusCircleFill } from 'react-icons/bs';
import { AiFillMinusCircle } from 'react-icons/ai';
const data = [
    {
        id: 1,
        question: "Zoorun কি?",
        answer: 'Zoorun একটি প্রযুক্তিনির্ভর লজিস্টিকস কোম্পানি যা দেশজুড়ে এসএমই প্রোডাক্ট ডেলিভারি সেবা থেকে শুরু করে ব্যাক্তিগত ডকুমেন্ট, পার্সেল ডেলিভারি, এবং বড় কর্পোরেট কোম্পানিগুলোকে ইন্ডাস্ট্রিয়াল লজিস্টিকস সেবা প্রদান করে থাকে।'
    },
    {
        id: 2,
        question: "Zoorun   কি কি ধরনের সেবা দিয়ে থাকে?",
        answer: 'যে কোন ব্যবসা বা ব্যক্তিগত প্রয়োজনে ডেলিভারি সংক্রান্ত সেবা প্রদানের একটি পূর্ণাঙ্গ প্ল্যাটফর্ম Zoorun। পার্সেল ডেলিভারি, বাল্ক শিপমেন্ট, লাইন হল, ট্রাক ভাড়া, লোডিং-আনলোডিং, ওয়্যারহাউজ, সার্ভিস হিসেবে লজিস্টিকস সল্যুশন এবং প্রয়োজন অনুযায়ী কাস্টমাইজড সল্যুশনও দিয়ে থাকে Zoorun।'
    },
    {
        id: 3,
        question: "Zoorun ডেলিভারির কভারেজ এরিয়া কি?",
        answer: 'Zoorun বাংলাদেশের ৬৪ টি জেলায় ডেলিভারি করে। আমাদের ডেলিভারি এরিয়া জানতে লিঙ্কে ক্লিক করুন https://google.com আপনার নিকটস্থ Zoorun হাবে যোগাযোগ করে আজই ডেলিভারি বুক করুন। Zoorun হাবের সম্পূর্ণ লিস্ট দেখতে এখানে ক্লিক করুন'
    },
    {
        id: 4,
        question: "আপনাদের লজিস্টিকস চার্জ সম্পর্কে জানতে চাই?",
        answer: 'মার্চেন্টদের পার্সেল ডেলিভারিতে আমরা প্রতি কেজি অনুযায়ী চার্জ করে থাকি l ঢাকার ভেতরে প্রতি কেজি ৬৯ টাকা, ঢাকার আশেপাশে ১১৫ এবং ঢাকার বাইরে ১৫০ টাকা থেকে চার্জ শুরু হয়। ঢাকার আশেপাশে এবং বাইরে প্রতি ডেলিভারিতে ১% ক্যাশ অন ডেলিভারি চার্জ প্রযোজ্য। প্রতিটি চার্জের সাথে ভ্যাট সংযুক্ত। ব্যক্তিগত পার্সেল পাঠানোর চার্জ সম্পর্কে জানতে আমাদের হোম ডেলিভারি এবং হাব ডেলিভারির প্রাইস চার্টটি দেখুন। এন্টারপ্রাইজ লজিস্টিকসের জন্য আমাদের দক্ষ সেলস টিম রয়েছে। ০৯১০০০৭৩৩৯ নাম্বারে কল দিয়ে এ সংক্রান্ত সকল তথ্য পাবেন।  অনুগ্রহপূর্বক মনে রাখবেন ওজন এবং অবস্থানের ভিত্তিতে ডেলিভারি চার্জ পরিবর্তন হতে পারে l এ বিষয়ে আরও বিস্তারিত জানতে লিঙ্কে ক্লিক করুন এবং আমাদের প্রাইস সম্পর্কে আরো বিস্তারিত জানুন l'
    },
]

export const Faq = () => {
    const [index, setIndex] = useState(1)
    return (
        <div className='my-20 container mx-auto flex items-center justify-center px-5 sm:px-5 md:px-0 lg:px-0'>
            <div className="mt-10 w-full sm:w-full md:w-1/2	lg:w-1/2">
                <p className='text-3xl font-bold text-center my-5' >আপনার সকল জিজ্ঞাসা</p>
                <p className='text-lg text-center' >সর্বাধিক জিজ্ঞাসিত প্রশ্নগুলি দেখুন, যেকোনো প্রয়োজনে আমরা আপনার পাশে আছি</p>



                {data.map((d, i) => (
                    <div style={{ borderBottomColor: "lightgray", borderBottomWidth: 1 }} className="my-5 pb-5">
                        <div onClick={() => setIndex(d.id)} className="flex items-center gap-5">
                            {d.id === index ? (
                                <AiFillMinusCircle color='green' size={24} />

                            ) : (
                                <BsPlusCircleFill color='green' size={24} />
                            )}
                            <p className='text-xl font-bold' >{d.question}</p>
                        </div>
                        {d.id === index && <p className='mt-5' >{d.answer}</p>}

                    </div>
                ))}





            </div>

        </div>
    );
}; 