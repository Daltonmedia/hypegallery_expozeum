Museum plugin for hypeGallery

FEATURES
========
1. Menu item for admins and curators to toggle a hypeGallery image as 'selected for the museum'.
2. Curator roles can be given to a user, using the admin user hover menu.
3. Owners of the image will get a message that they are selected.
4. Owners of images that are selected but are 'not public' will get a message that they were selected, but won't be in the museum untill they change theire album privacy to 'public'. If after a week they still haven't. Their image will be toggled to 'not exposed' again by the daily cron.
5. User has a usersettings page for the museum, giving them the option to 'not be curated'. This means their images can't be selected by the curators.
6. When users visit the usersettings page and they currently have items in the museum, they will be warned that setting the option to 'no' will remove their image(s) from the museum.
7. If they proceed and set their setting to 'no', all current museum items of the user will be unset and the items will not appear in the museum anymore.

NOTES
=====
1. Images must be complete public, since the museum is a public place, if images are selected that are not public, the user will get a notification asking him to make his album public.
Untill he does, his image won't appear in the museum and will be deleted after a week.
2. Daily Cron 'must' be configured for garbage items to be collected and removed.
3. This is a hypeGallery addon, so hypeGallery must be installed and enabled for this to work.
[hypeGallery](https://github.com/hypejunction/hypeGallery "hypeGallery")


CREDITS
=======
Based on Juho Jaakkola's 'featured-content' plugin for Elgg.
[Elgg-featured_content](https://github.com/juho-jaakkola/elgg-featured_content "Elgg-featured_content")

TODO
====
1. Add a relationship between the user and his image 'was_exposed' when an item is curated for the museum, to find back the users museum items in a later stadium for the users (not sure if this is needed).
2. Add a cron to clean up the NON-PUBLIC entities that have the md expozeum->true set longer then one week ago since they have a week to change their access for the container album to public (need to figure that out, actually just the way to get the entities where the metadata is set on that particular timestamp...)
