/**
 * GSAP + ScrollTrigger, exposed as globals because fx.js feature-detects window.gsap.
 */
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
