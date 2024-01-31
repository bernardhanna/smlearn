// Courses.jsx
import React from 'react';
import { Link } from '@inertiajs/inertia-react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

export default function Courses({ auth, courses }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="text-xl font-semibold leading-tight text-gray-800">Courses</h2>}
        >
            <Head title="Courses" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        {courses.map(course => (
                            <Link key={course.id} href={route('course.quiz', course.course_name)}>
                                <div className="overflow-hidden bg-white rounded-lg shadow hover:shadow-md">
                                    <div className="px-4 py-5 sm:p-6">
                                        <h3 className="text-lg font-medium leading-6 text-gray-900">{course.course_name}</h3>
                                        <p className="mt-1 text-sm text-gray-600">{course.description}</p>
                                    </div>
                                </div>
                            </Link>
                        ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
