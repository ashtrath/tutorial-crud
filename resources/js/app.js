import './bootstrap'

import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'
import PerfectScrollbar from 'perfect-scrollbar'
import Swal from 'sweetalert2'
import {DataTable} from "simple-datatables";
import 'flowbite'

window.PerfectScrollbar = PerfectScrollbar
window.Swal = Swal
window.DataTable = DataTable

document.addEventListener('alpine:init', () => {
    Alpine.data('mainState', () => {
        let lastScrollTop = 0
        const init = function () {
            window.addEventListener('scroll', () => {
                let st = window.scrollY || document.documentElement.scrollTop
                if (st > lastScrollTop) {
                    // downscroll
                    this.scrollingDown = true
                    this.scrollingUp = false
                } else {
                    // upscroll
                    this.scrollingDown = false
                    this.scrollingUp = true
                    if (st === 0) {
                        //  reset
                        this.scrollingDown = false
                        this.scrollingUp = false
                    }
                }
                lastScrollTop = st <= 0 ? 0 : st // For Mobile or negative scrolling
            })
        }

        const getTheme = () => {
            if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'))
            }
            return (!!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)
        }
        const setTheme = (value) => {
            window.localStorage.setItem('dark', value)
        }
        return {
            init, isDarkMode: getTheme(), toggleTheme() {
                this.isDarkMode = !this.isDarkMode
                setTheme(this.isDarkMode)
            }, isSidebarOpen: window.innerWidth > 1024, isSidebarHovered: false, handleSidebarHover(value) {
                if (window.innerWidth < 1024) {
                    return
                }
                this.isSidebarHovered = value
            }, handleWindowResize() {
                this.isSidebarOpen = window.innerWidth > 1024;
            }, scrollingDown: false, scrollingUp: false,
        }
    })
})

Alpine.plugin(collapse)

Alpine.start()
