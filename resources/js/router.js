import HomeComponent from "./components/Pages/HomeComponent";
import MixTapeComponent from "./components/Pages/MixTapeComponent";
import ListOnHeadComponent from "./components/Pages/ListOnHeadComponent";
import ArtistDetailComponent from "./components/Pages/ArtistDetailComponent";
import CommunityComponent from "./components/Pages/CommunityComponent";
import CommunityDetailComponent from "./components/Pages/CommunityDetailComponent";
import ConversationComponent from "./components/Pages/ConversationComponent";
import ConversationDetailComponent from "./components/Pages/ConversationDetailComponent";

export const routes = [
    { path: '/', component: HomeComponent, name: 'Home' },
    { path: '/detail', component: ArtistDetailComponent, name: 'detail' },
    { path: '/mixtape', component: MixTapeComponent, name: 'MixTape'},
    { path: '/listhead', component: ListOnHeadComponent, name: 'ListOnHead'},
    { path: '/comunity', component: CommunityComponent, name: 'Community'},
    { path: '/community-detail', component: CommunityDetailComponent, name: 'CommunityDetail'},
    { path: '/conversation', component: ConversationComponent, name: 'Conversation'},
    { path: '/conversation-detail', component: ConversationDetailComponent, name: 'ConversationDetail'}
];
