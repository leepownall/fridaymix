import React from 'react'
import Layout from '../../Layout'
import { Link } from '@inertiajs/inertia-react'

export default function Index(props) {
    const { playlists } = props

    return (
        <Layout>
            <ul>
                {playlists.map((item) => {
                    return <li key={item.id}>
                        <Link href={`show/${item.id}`} className='text-blue-500'>{item.name}</Link>
                    </li>
                })}
            </ul>
        </Layout>
    )
}
