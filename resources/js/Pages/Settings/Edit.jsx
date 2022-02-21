import React from 'react'
import Layout from '../../Layout'
import { useForm } from '@inertiajs/inertia-react'

export default function Edit(props) {
    const { data, setData, post, processing, errors } = useForm({
        username: props.username,
        startTime: props.startTime,
    })

    function submit(e) {
        e.preventDefault()
        post('/settings')
    }

    return (
        <Layout>
            <form onSubmit={submit} className='flex flex-col space-y-5'>
                <div>
                    <label className="block text-sm font-medium text-gray-700">Username</label>
                    <div className="mt-1">
                        <input
                            type="text"
                            name="username"
                            id="username"
                            className="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            value={data.username}
                            onChange={e => setData('username', e.target.value)}
                        />
                    </div>
                    {errors.username && <p className="mt-2 text-sm text-red-600">{errors.username}</p>}
                </div>

                <div>
                    <label className="block text-sm font-medium text-gray-700">Username</label>
                    <div className="mt-1">
                        <input
                            type="text"
                            name="startTime"
                            id="startTime"
                            className="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            value={data.startTime}
                            onChange={e => setData('startTime', e.target.value)}
                        />
                    </div>
                    {errors.startTime && <p className="mt-2 text-sm text-red-600">{errors.startTime}</p>}
                </div>

                <button
                    disabled={processing}
                    type="submit"
                    className="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Update
                </button>
            </form>
        </Layout>
    )
}
