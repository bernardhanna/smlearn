import React, { useState, useEffect, useRef } from 'react';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import axios from 'axios';

const Quiz = ({ questions: initialQuestions, user, course }) => {
    const [currentQuestionIndex, setCurrentQuestionIndex] = useState(0);
    const [questions, setQuestions] = useState(initialQuestions);
    const [userAnswer, setUserAnswer] = useState('');
    const [error, setError] = useState('');
    const [quizCompleted, setQuizCompleted] = useState(initialQuestions.length === 0);
    const [showAnswer, setShowAnswer] = useState(false);
    const [isListening, setIsListening] = useState(false);
    const [speechAnswer, setSpeechAnswer] = useState('');
    const recognitionRef = useRef(null);
    const [correctSpeechCount, setCorrectSpeechCount] = useState(0);
    const [correctAnswersCount, setCorrectAnswersCount] = useState(0);

    const currentQuestion = questions[currentQuestionIndex];

    const handleIKnowThis = (questionId) => {
        axios.post('/mark-question-known', {
            userId: user.id,
            questionId: questionId,
            courseId: course.id
        }).then(() => {
            const updatedQuestions = questions.filter(q => q.id !== questionId);
            setQuestions(updatedQuestions);
            if (currentQuestionIndex >= updatedQuestions.length) {
                setQuizCompleted(true);
            } else {
                setCurrentQuestionIndex(currentQuestionIndex + 1 < updatedQuestions.length ? currentQuestionIndex : 0);
            }
        }).catch(error => {
            console.error('Error marking question as known:', error);
        });
    };

    const resetQuiz = () => {
        setCurrentQuestionIndex(0);
        setQuizCompleted(false);
        setCorrectAnswersCount(0);
    };

    const renderQuestionInput = (questionType, questionData) => {
        if (!questionData) return <p>Loading question...</p>;
        switch (questionType) {
            case 'text':
                return <input type="text" value={userAnswer} onChange={(e) => setUserAnswer(e.target.value)} className="w-full input-class" />;
            case 'textarea':
                return <textarea value={userAnswer} onChange={(e) => setUserAnswer(e.target.value)} className="w-full h-[500px] textarea-class"></textarea>;
            case 'fill-in-the-blank':
                return <input type="text" value={userAnswer} onChange={(e) => setUserAnswer(e.target.value)} className="input-class" />;
            case 'true-false':
                return (
                    <div>
                        <label>
                            <input type="radio" name="true-false" value="true" onChange={(e) => setUserAnswer(e.target.value)} className="m-2" />
                            True
                        </label>
                        <label>
                            <input type="radio" name="true-false" value="false" className="m-2" onChange={(e) => setUserAnswer(e.target.value)} />
                            False
                        </label>
                    </div>
                );
            default:
                return <input type="text" />;
        }
    };

    const normalizeString = (str) => {
        return str.trim().toLowerCase().replace(/\s+/g, ' ').replace(/[\r\n]+/g, ' ');
    };

    const handleAnswerSubmit = (e) => {
        e.preventDefault();
        const normalizedUserAnswer = normalizeString(userAnswer);
        let normalizedCorrectAnswers = normalizeString(currentQuestion.answer);
        let isCorrect = false;

        try {
            // Attempt to parse the answer in case it's a JSON-encoded array
            const potentialAnswers = JSON.parse(normalizedCorrectAnswers);
            if (Array.isArray(potentialAnswers)) {
                // If the answer is an array, check if the user's answer matches any of the correct answers
                isCorrect = potentialAnswers.some(answer => normalizeString(answer) === normalizedUserAnswer);
            } else {
                // If parsing doesn't result in an array, treat it as a regular string comparison
                isCorrect = normalizedUserAnswer === normalizedCorrectAnswers;
            }
        } catch (error) {
            // Fallback to treating the answer as a normal string if JSON parsing fails
            isCorrect = normalizedUserAnswer === normalizedCorrectAnswers;
        }

        if (isCorrect) {
            setCorrectAnswersCount(prevCount => prevCount + 1);
            moveToNextQuestion();
        } else {
            setError('Incorrect answer. Try again.');
        }
    };

    const moveToNextQuestion = () => {
        setError('');
        setUserAnswer('');
        setShowAnswer(false); // Reset showAnswer when moving to the next question
        if (currentQuestionIndex + 1 < questions.length) {
            setCurrentQuestionIndex(currentQuestionIndex + 1);
        } else {
            setQuizCompleted(true);
        }
    };

    const handleSkipQuestion = () => {
        setShowAnswer(false); // Reset showAnswer when skipping the question
        moveToNextQuestion();
    };

    const handleShowAnswer = () => {
        setShowAnswer(!showAnswer);
    };

    const toggleListening = () => {
        if (isListening && recognitionRef.current) {
            recognitionRef.current.stop();
            setIsListening(false);
        } else if (recognitionRef.current) {
            recognitionRef.current.start();
            setIsListening(true);
        }
    };

    const handlePreviousQuestion = () => {
        setError('');
        setUserAnswer('');
        setShowAnswer(false); // Reset showAnswer when moving to the previous question
        if (currentQuestionIndex > 0) {
            setCurrentQuestionIndex(currentQuestionIndex - 1);
        }
    };

    useEffect(() => {
        if (!questions.length) {
            setQuizCompleted(true);
        }
    }, [questions]);

    useEffect(() => {
        const initializeSpeechRecognition = () => {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (!SpeechRecognition) {
                alert('Speech recognition not supported in this browser. Please use Chrome or Edge.');
                return;
            }
            if (!recognitionRef.current) {
                recognitionRef.current = new SpeechRecognition();
                recognitionRef.current.continuous = true;
                recognitionRef.current.interimResults = true;
                recognitionRef.current.onresult = event => {
                    const last = event.results.length - 1;
                    const result = event.results[last][0].transcript.trim().toLowerCase();
                    setSpeechAnswer(result);
                    if (result === normalizeString(currentQuestion.answer)) {
                        setCorrectSpeechCount(prevCount => prevCount + 1);
                        if (correctSpeechCount + 1 === 5) {
                            setCorrectSpeechCount(0);
                            moveToNextQuestion();
                        }
                    } else {
                        setCorrectSpeechCount(0);
                    }
                };
            }
        };
        initializeSpeechRecognition();
        return () => {
            if (recognitionRef.current) {
                recognitionRef.current.stop();
            }
        };
    }, [questions, currentQuestionIndex]);

    if (!questions.length) {
        return (
            <AuthenticatedLayout user={user}>
                <div className="container mx-auto">
                    <h1 className="text-xl font-bold">You know Everything - Course Complete!</h1>
                    <div className="mt-4">
                        <Link href="/courses" className="px-4 py-2 mr-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                            Back to Courses
                        </Link>
                    </div>
                </div>
            </AuthenticatedLayout>
        );
    }

    if (quizCompleted) {
        return (
            <AuthenticatedLayout user={user}>
                <div className="container mx-auto">
                    <h1 className="text-xl font-bold">Quiz Completed!</h1>
                    <p className="mt-2 text-lg">Total Correct Answers: {correctAnswersCount}</p>
                    <div className="mt-4">
                        <Link href="/courses" className="px-4 py-2 mr-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                            Back to Courses
                        </Link>
                        <button onClick={resetQuiz} className="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline">
                            Try Again
                        </button>
                    </div>
                </div>
            </AuthenticatedLayout>
        );
    }

    return (
        <AuthenticatedLayout user={user}>
        <div className="container mx-auto">
            <h1 className="mb-4 text-xl font-bold">Quiz</h1>
            <form onSubmit={handleAnswerSubmit}>
                <div className="mb-4">
                    <label className="block mb-2 text-sm font-bold text-gray-700">
                        {currentQuestionIndex + 1}. {questions[currentQuestionIndex].question}
                    </label>
                    {renderQuestionInput(questions[currentQuestionIndex].type, questions[currentQuestionIndex])}
                </div>
                {error && <p className="text-xs italic text-red-500">{error}</p>}

                {showAnswer && (
                    <p className="text-green-500">
                        Answer: {
                            (() => {
                                try {
                                    // Attempt to parse the answer to check if it's a JSON-encoded array
                                    const answersArray = JSON.parse(currentQuestion.answer);
                                    if (Array.isArray(answersArray)) {
                                        // If it's an array, join the answers with ' OR '
                                        return answersArray.join(" OR ");
                                    }
                                } catch (error) {
                                    // If parsing fails, it means it's a single answer, not JSON-encoded
                                }
                                // Fallback for single answers or if parsing fails
                                return currentQuestion.answer;
                            })()
                        }
                    </p>
                )}

                <button type="submit" className="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                    Submit Answer
                </button>
                <button type="button" onClick={handleShowAnswer} className="px-4 py-2 ml-4 font-bold text-white bg-green-500 rounded hover:bg-green-700 focus:outline-none focus:shadow-outline">
                    Show Answer
                </button>
                <button type="button" onClick={toggleListening} className="px-4 py-2 ml-4 font-bold text-white bg-purple-500 rounded hover:bg-purple-700 focus:outline-none focus:shadow-outline">
                {isListening ? 'Stop Listening' : 'Start Listening'}
                </button>
                <button type="button" onClick={handlePreviousQuestion} className="px-4 py-2 ml-4 font-bold text-white bg-yellow-500 rounded hover:bg-yellow-700 focus:outline-none focus:shadow-outline">
                    Previous Question
                </button>
                <button type="button" onClick={handleSkipQuestion} className="px-4 py-2 ml-4 font-bold text-white bg-gray-500 rounded hover:bg-gray-700 focus:outline-none focus:shadow-outline">
                    Skip Question
                </button>
                <button type="button" onClick={() => handleIKnowThis(questions[currentQuestionIndex].id, course.slug)} className="px-4 py-2 ml-4 font-bold text-white bg-orange-500 rounded hover:bg-orange-700 focus:outline-none focus:shadow-outline">
                    I Know This
                </button>
            </form>
            {speechAnswer && <p>Speech Answer: {speechAnswer} (Correct Count: {correctSpeechCount}/5)</p>}
        </div>
    </AuthenticatedLayout>
    );
};

export default Quiz;
