import React, { useEffect, useState } from 'react';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

const StuffIKnow = (auth, user) => {
    const [knownQuestions, setKnownQuestions] = useState([]);

    useEffect(() => {
        axios.get('/known-questions').then(response => {
            setKnownQuestions(response.data);
        });
    }, []);

    const handleRestoreQuestion = (questionId) => {
        axios.delete(`/unmark-question-known/${questionId}`)
            .then(response => {
                // Filter out the restored question from the knownQuestions array
                const updatedQuestions = knownQuestions.filter(question => question.id !== questionId);
                setKnownQuestions(updatedQuestions);

                console.log('Question restored:', response.data);
            })
            .catch(error => {
                console.error('Error restoring question:', error);
            });
    };

    return (
        <AuthenticatedLayout user={user}>
            <div className="container p-4 mx-auto">
                <h1 className="mb-4 text-2xl font-bold">Stuff I Know</h1>
                <ul className="pl-5 list-disc">
                    {knownQuestions.map(question => (
                        <li key={question.id} className="mb-2">
                            <div className="flex items-center justify-between">
                                <span className="text-lg">{question.question} (Course: {question.course_name})</span>
                                <button onClick={() => handleRestoreQuestion(question.id)} className="px-4 py-2 text-white transition-colors bg-green-500 rounded hover:bg-green-700">
                                    Restore
                                </button>
                            </div>
                        </li>
                    ))}
                </ul>
            </div>
    </AuthenticatedLayout>
    );
};

export default StuffIKnow;
