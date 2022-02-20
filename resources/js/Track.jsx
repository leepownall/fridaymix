import React from 'react'
import classNames from 'classnames'

export default function Track(props) {
    const { track, isCurrent, currentTime } = props

    const containerClassName = classNames({
        'flex items-center space-x-4': true,
        'opacity-50': !isCurrent,
    })

    const trackStatusClassName = classNames({
        'inline-flex items-center shadow-sm px-2.5 py-0.5 border text-sm leading-5 font-medium rounded-full': true,
        'border-gray-300 text-gray-700 bg-white hover:bg-gray-50': !isCurrent,
        'border-green-400 text-green-900 bg-green-300 hover:bg-green-400': isCurrent,
    })

    return (
        <div className={containerClassName}>
            <div className="flex-shrink-0">
                <img className="h-8 w-8 rounded-full" src={track.imageUrl} alt="" />
            </div>
            <div className="flex-1 min-w-0">
                <p className="text-sm font-medium text-gray-900 truncate">{track.name}</p>
                <p className="text-sm text-gray-500 truncate">{track.album}</p>
            </div>
            <div>
                <span className={trackStatusClassName}>
                    {isCurrent ? currentTime : track.startsAt}
                </span>
            </div>
        </div>
        )
}
