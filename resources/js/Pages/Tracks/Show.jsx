import React, { useEffect, useState } from 'react'
import Layout from '../../Layout'
import Track from '../../Track'
import { DateTime } from 'luxon'

export default function Show (props) {
    const { tracks } = props

    const [date, setDate] = useState(new Date())

    useEffect(() => {
        let timer = setInterval(() => setDate(new Date()), 1000)
        return function cleanup () {
            clearInterval(timer)
        }
    })

    const isCurrent = (track) => {
        return date.toLocaleTimeString() >= track.startsAt && date.toLocaleTimeString() <= track.endsAt
    }

    const currenTime = (track) => {
        let start = DateTime.fromFormat(track.startsAt, 'HH:mm:ss')

        return DateTime.fromFormat(date.toLocaleTimeString(), 'HH:mm:ss').diff(start).toFormat('mm:ss')
    }

    return (<Layout>
            <div className="flow-root mt-6">
                <ul role="list" className="-my-5 divide-y divide-gray-200">
                    {tracks.map((track) => {
                        return <li key={track.id} className="py-4">
                            <Track
                                track={track}
                                isCurrent={isCurrent(track)}
                                currentTime={currenTime(track)}
                            />
                        </li>
                    })}
                </ul>
            </div>
        </Layout>)
}
