import { file } from "astro/loaders";
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
    iPhoneAppLinks: defineCollection({
        loader: file("src/content/lists/iPhoneAppLinks.json"),
        schema: z.object({
            title: z.string(),
            url: z.string(),
            blank: z.boolean(),
        }),
    }),
};
