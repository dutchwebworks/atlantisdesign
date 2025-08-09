import { file, glob } from "astro/loaders";
import { defineCollection, z } from "astro:content";

export const collections = {
    menu: defineCollection({
        loader: file("src/content/lists/Menu.json"),
        schema: z.object({
            id: z.number(),
            title: z.string(),
            url: z.string(),
            accessKey: z.string().optional(),
        }),
    }),
    articles: defineCollection({
        loader: glob({
            pattern: "**/*.md",
            base: "src/content/articles",
        }),
        schema: z.object({
            title: z.string(),
            description: z.string(),
            pubDate: z.date(),
        }),
    }),
    iPhoneAppLinks: defineCollection({
        loader: file("src/content/lists/iPhoneAppLinks.json"),
        schema: z.object({
            title: z.string(),
            url: z.string(),
            blank: z.boolean(),
        }),
    }),
    iPhoneLinks: defineCollection({
        loader: file("src/content/lists/iPhoneLinks.json"),
        schema: z.object({
            id: z.number(),
            title: z.string(),
            url: z.string(),
            blank: z.boolean(),
        }),
    }),
    cssWebdesign: defineCollection({
        loader: file("src/content/lists/CssWebdesign.json"),
        schema: z.object({
            id: z.number(),
            title: z.string(),
            url: z.string(),
            blank: z.boolean(),
        }),
    }),
    externalWebsites: defineCollection({
        loader: file("src/content/lists/ExternalWebsites.json"),
        schema: z.object({
            id: z.number(),
            title: z.string(),
            url: z.string(),
            blank: z.boolean(),
        }),
    }),
    iTunesMusicStore: defineCollection({
        loader: file("src/content/lists/iTunesMusicStore.json"),
        schema: z.object({
            id: z.number(),
            title: z.string(),
            url: z.string(),
            blank: z.boolean(),
        }),
    }),
    macOSX: defineCollection({
        loader: file("src/content/lists/MacOSX.json"),
        schema: z.object({
            id: z.number(),
            title: z.string(),
            url: z.string(),
            blank: z.boolean(),
        }),
    }),
    webServers: defineCollection({
        loader: file("src/content/lists/WebServers.json"),
        schema: z.object({
            id: z.number(),
            title: z.string(),
            url: z.string(),
            blank: z.boolean(),
        }),
    }),
    widgets: defineCollection({
        loader: file("src/content/lists/Widgets.json"),
        schema: z.object({
            id: z.number(),
            title: z.string(),
            url: z.string(),
            blank: z.boolean(),
        }),
    }),
    wiiGames: defineCollection({
        loader: file("src/content/lists/WiiGames.json"),
        schema: z.object({
            title: z.string(),
            urlYouTube: z.string(),
            urlStore: z.string(),
            img: z.string(),
        }),
    }),
    wiiLinks: defineCollection({
        loader: file("src/content/lists/WiiLinks.json"),
        schema: z.object({
            id: z.number(),
            title: z.string(),
            url: z.string(),
            blank: z.boolean(),
        }),
    }),
};
