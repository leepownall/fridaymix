import './bootstrap';
import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'
import collapse from '@alpinejs/collapse'
import Toolkit from '@alpine-collective/toolkit'
import { livewire_hot_reload } from 'virtual:livewire-hot-reload'
import { DateTime } from 'luxon'
import Tooltip from "@ryangjchandler/alpine-tooltip"

Alpine.plugin(Toolkit)
Alpine.plugin(focus)
Alpine.plugin(collapse)
Alpine.plugin(Tooltip)

window.DateTime = DateTime
window.Alpine = Alpine

Alpine.start()

livewire_hot_reload()
